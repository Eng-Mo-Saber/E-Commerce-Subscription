@extends('layouts.app')

@section('title', 'Subscriptions')

@section('content')
    <div class="container py-5 " style="margin-top: 100px;">
        <h2 class="text-center mb-4">الاشتراكات المتاحة للخدمة {{ $service->name }} :</h2>

        <div class="row">
            @foreach ($service->subscriptions as $subscription)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <h4 class="text-primary fw-bold">{{ $subscription->name }}</h4>
                            <p class="mb-1 text-muted">النوع: {{ $subscription->type }}</p>
                            <p class="mb-1 text-muted">الوصف: {{ $subscription->description }}</p>
                            <p class="mb-1 text-muted">السعر: {{ $subscription->price }} جنيه</p>
                            <p class="mb-3 text-muted">عدد الأيام: {{ $subscription->duration_in_days }} يوم</p>
                            <div class="mb-3">
                            </div>

                            <a href="{{ route('payment.page', $subscription->id) }}" class="btn btn-success mt-auto">اشترك في الخدمة</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
