@extends('layouts.app')

@section('title', 'Order Details')

@section('content')

<div class="container py-3" style="margin-top: 150px;">
    
    <div class="card p-4 shadow-sm mb-3 bg-light border border-primary border-2 center text-center">
        <h2 class="mb-4 text-center fw-bold text-primary fs-3 ">Invoice Details</h2>

        <div class="row mb-3">
            <div class="col-md-6"><strong>User ID:</strong> #  {{ $userSubscription->user->id }}</div>
            <div class="col-md-6"><strong>User Name:</strong> {{ $userSubscription->user->name }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6"><strong>Payment ID:</strong> #  {{ $payment->id }}</div>
            <div class="col-md-6"><strong>Payment Method:</strong> {{ $payment->type_payment }}</div>
        </div>

        <div class="row mb-3">
            @if ($userSubscription->auto_renew == 1)
            <div class="col-md-6"><strong>Auto Renew:</strong> Yes </div>
            @else
            <div class="col-md-6"><strong>Auto Renew:</strong> No</div>
            @endif
        </div>

        <div class="row mb-3">
            <div class="col-md-6"><strong>Start Date:</strong> {{ $userSubscription->created_at }}</div>
            <div class="col-md-6"><strong>End Date:</strong> {{ $userSubscription->end_date }} </div>
        </div>

        <div class="mb-3">
            <strong>Status:</strong>
            @if ($userSubscription->status == 'active')
            <span class="text-success">Active</span>
            @else
            <span class="text-danger">Not Active</span>
            @endif
        </div>

        <hr>

        <h4 class="mt-3 mb-3 fw-bold text-primary">Subscription Details</h4>

        <div class="row mb-3">
            <div class="col-md-6"><strong>Subscription ID:</strong> #  {{ $userSubscription->id }}</div>
            <div class="col-md-6"><strong>Service Type:</strong> {{ $userSubscription->subscription->type }}</div>
        </div>

        <div class="mb-3">
            <strong>Description:</strong>
            <p>{{ $userSubscription->subscription->description }}</p>
        </div>

        <div class="mb-3">
            <strong>Price:</strong> {{ $userSubscription->subscription->price }} EGP</div>
        </div>

    </div>
</div>
@endsection