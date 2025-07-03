@extends('layouts.appDashboard')

@section('title', 'Order Details')

@section('content')
    <div class="container my-5 py-3">

        <div class="card p-4 shadow-sm mb-3 bg-light border border-primary border-2 center text-center">
            <h4 class="mt-3 mb-3 fw-bold text-primary">User Details</h4>
            {{-- عرض معلومات عن المستخدم وعن الاوردر --}}
            <div class="row mb-3">
                <div class="col-md-6"><strong>User ID: {{ $order->user_id }}</strong> # </div>
                <div class="col-md-6"><strong>Order ID:</strong> # {{ $order->id }} </div>
                <div class="col-md-6"><strong>User name:</strong> {{ $order->user->name }} </div>
                <div class="col-md-6"><strong>Email:</strong> {{ $order->user->email }} </div>
                <div class="col-md-6"><strong>Phone:</strong> {{ $order->user->phone }} </div>
                <div class="col-md-6"><strong>Address:</strong> {{ $order->address }} </div>
            </div>
        </div>

        <h2 class="mb-4 text-center fw-bold text-primary fs-3 ">Order Details</h2>
        {{-- عرض تفاصيل المنتجات اللي جوا الاوردر --}}
        @php
            $total_price = 0;
        @endphp
        @foreach ($order_items as $item)
            <div class="row mb-3">
                <div class="col-md-6"><strong>Product Name: </strong> {{ $item->product->name }} </div>
                <div class="col-md-6"><strong>Product Quantity: </strong> {{ $item->quantity }} </div>
                <div class="col-md-6"><strong>Product Price: </strong>{{ $item->product->price }}</div>
            </div>
            @php
                $total_price += $item->quantity * $item->product->price ;
            @endphp
            <hr>
        @endforeach

        <div class="mb-3 text-center">
            <strong>Total Price :</strong>
            <span class="text-success"> {{ $total_price }} </span>
        </div>

    </div>
    </div>
@endsection
