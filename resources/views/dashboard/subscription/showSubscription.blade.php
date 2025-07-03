@extends('layouts.appDashboard')

@section('title', 'Subscription List')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Subscriptions</h3>
            <a href="{{ route('dashboard.addSubscription') }}" class="btn btn-primary float-right">Add Subscription</a>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                @if (session('error'))
                    <div class="d-flex justify-content-center mt-3">
                        <div class="alert alert-danger w-50 text-center">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                @if (session('success'))
                    <div class="d-flex justify-content-center mt-3">
                        <div class="alert alert-success w-50 text-center">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>price</th>
                        <th>duration_in_days</th>
                        <th>Service</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscriptions as $subscription)
                        <tr>
                            <td>{{ $subscription->id }}</td>
                            <td>{{ $subscription->name }}</td>
                            <td>{{ $subscription->description }}</td>
                            <td>{{ $subscription->price }}</td>
                            <td>{{ $subscription->duration_in_days }}</td>
                            <td>{{ $subscription->service->name }}</td>

                            <td>
                                <a href="{{ route('dashboard.updateSubscription', $subscription->id) }}"
                                    class="btn btn-sm btn-warning btn-warning mb-1">Edit</a>
                                <form action="{{ route('deleteSubscription.destroy', $subscription->id) }}" method="GET">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
