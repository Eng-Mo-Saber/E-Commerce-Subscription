@extends('layouts.app')

@section('title', 'My subscriptions')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4" style="margin-top: 150px;">الاشتراكات السارية</h2>

        <div class="row">
            @forelse ($userSubscriptions as $userSubscription)
                @if ($userSubscription->status == 'active')
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm p-3">
                            <h5>{{ $userSubscription->subscription->name }}</h5>
                            <p>الحالة: <span class="text-success">ساري</span></p>
                            <p>ينتهي في: {{ $userSubscription->end_date }}</p>
                            <a href="{{ route('payment-invoice.page', $userSubscription->id) }}" class="btn btn-outline-primary mt-auto">عرض الفاتورة</a>
                        </div>
                    </div>
                @endif
            @empty
                <p>لا يوجد اشتراكات خاصة بك.</p>
            @endforelse
        </div>
    </div>

    <div class="container my-5">
        <h2 class="mb-4" style="margin-top: 100px;">الاشتراكات المنتهية</h2>

        <div class="row">
            @forelse ($userSubscriptions as $userSubscription)
                @if ($userSubscription->status == 'not_active')
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm p-3">
                            <h5>{{ $userSubscription->subscription->name }}</h5>
                            <p>الحالة: <span class="text-danger">منتهي</span></p>
                            <p>انتهى في: {{ $userSubscription->end_date }}</p>
                            <a href="{{ route('payment-invoice.page', $userSubscription->id) }}"
                                class="btn btn-outline-secondary mt-auto">عرض الفاتورة</a>
                        </div>
                    </div>
                @endif
            @empty
                <p>لا يوجد اشتراكات منتهية.</p>
            @endforelse
        </div>
    </div>

@endsection
