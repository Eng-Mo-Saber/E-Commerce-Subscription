@extends('layouts.app')

@section('title', 'My subscriptions')

@section('content')
    <div class="container my-5">

        {{-- الاشتراكات السارية --}}
        <h2 class="mb-4" style="margin-top: 150px;">الاشتراكات السارية</h2>

        <div class="row">
            @forelse ($userSubscriptions->where('status', 'active') as $userSubscription)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm p-3 d-flex flex-column justify-content-between">
                        <div>
                            <h5>{{ $userSubscription->subscription->name }}</h5>
                            <p>الحالة: <span class="text-success">ساري</span></p>
                            <p>ينتهي في: {{ $userSubscription->end_date }}</p>
                        </div>
                        <div class="d-flex gap-2 mt-auto">
                            <a href="{{ route('payment-invoice.page', $userSubscription->id) }}"
                                class="btn btn-outline-primary flex-fill">
                                عرض الفاتورة
                            </a>

                            <form action="{{ route('my-subscription.destroy', $userSubscription->id) }}" method="POST"
                                onsubmit="return confirm('هل أنت متأكد من إلغاء الاشتراك❌؟');" class="flex-fill">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    إلغاء الإشتراك
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted text-center">لا يوجد اشتراكات خاصة بك.</p>
            @endforelse
        </div>

        <hr class="my-5">

        {{-- الاشتراكات المنتهية --}}
        <h2 class="mb-4">الاشتراكات المنتهية</h2>

        <div class="row">
            @forelse ($userSubscriptions->where('status', 'not_active') as $userSubscription)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm p-3 d-flex flex-column justify-content-between">
                        <div>
                            <h5>{{ $userSubscription->subscription->name }}</h5>
                            <p>الحالة: <span class="text-danger">منتهي</span></p>
                            <p>انتهى في: {{ $userSubscription->end_date }}</p>
                        </div>
                        <a href="{{ route('payment-invoice.page', $userSubscription->id) }}"
                            class="btn btn-outline-secondary mt-auto">
                            عرض الفاتورة
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-muted text-center">لا يوجد اشتراكات منتهية.</p>
            @endforelse
        </div>
    </div>
@endsection
