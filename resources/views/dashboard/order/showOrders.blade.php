@extends('layouts.appDashboard')

@section('title', 'Orders List')

@section('content')
    <div class="card">

        <div class="card-body table-responsive p-0">
            @if (session('success'))
                <div class="d-flex justify-content-center mt-3">
                    <div class="alert alert-success w-50 text-center">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $sortedOrders = $orders->sortBy(function($order){
                        return match ($order->status) {
                            'pending' =>0 ,
                            'shipping' =>1 ,
                            'completed' =>2 ,
                            default => 'rejected'
                        };
                    });
                    @endphp
                    @foreach ($sortedOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->user->phone }}</td>
                            <td>
                                @if ($order->status == 'shipped')
                                    <label class="border p-1 rounded bg-light text-center">Order shipped </label>
                                @elseif ($order->status == 'rejected')
                                    <label class="border p-1 rounded bg-danger text-center">Order UnAccepted </label>

                                @elseif($order->status == 'completed')
                                    <label class="border p-1 rounded bg-success text-center">Order completed </label>
                                @else
                                    <label class="border p-1 rounded bg-warning text-center">Order Pending </label>
                                @endif
                            </td>
                            <td>
                                @if ($order->status == 'shipped')
                                    <a href="{{ route('dashboard.detailsOrder', $order->id) }}"
                                        class="btn btn-sm btn-warning">Show Details</a>
                                @elseif ($order->status == 'rejected')
                                    <a href="{{ route('dashboard.detailsOrder', $order->id) }}"
                                        class="btn btn-sm btn-warning">Show Details</a>
                                @elseif($order->status == 'completed')
                                    <a href="{{ route('dashboard.detailsOrder', $order->id) }}"
                                        class="btn btn-sm btn-warning">Show Details</a>
                                @else
                                    <a href="{{ route('dashboard.acceptedOrder', $order->id) }}"
                                        class="btn btn-sm btn-success ">Acceptable</a>
                                    <a href="{{ route('dashboard.unAcceptedOrder', $order->id) }}"
                                        class="btn btn-sm btn-danger">UnAcceptable</a>
                                    <a href="{{ route('dashboard.detailsOrder', $order->id) }}"
                                        class="btn btn-sm btn-warning">Show Details</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
