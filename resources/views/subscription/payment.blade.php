@extends('layouts.app')

@section('title', 'تفاصيل الاشتراك والدفع')

@section('content')
    <div class="container py-5" style="margin-top: 100px;">
        <div class="row">
            {{-- ✅ تفاصيل الاشتراك --}}
            <div class="col-md-5">
                <div class="card shadow-sm p-4">
                    <h3 class="text-primary fw-bold mb-3">{{ $subscription->name }}</h3>
                    <p><strong>النوع:</strong> {{ $subscription->type }}</p>
                    <p><strong>الوصف:</strong> {{ $subscription->description }}</p>
                    <p><strong>السعر:</strong> {{ $subscription->price }} جنيه</p>
                    <p><strong>عدد الأيام:</strong> {{ $subscription->duration_in_days }} يوم</p>
                </div>
            </div>

            {{--  فورم الدفع --}}
            <div class="col-md-7">
                <div class="card shadow-sm p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('payment.kashier') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">

                        {{-- تجديد تلقائي --}}
                        <div class="mb-3">
                            <label class="form-label">تجديد تلقائي؟</label>
                            <select class="form-select" name="auto_renew" required>
                                <option value="1">نعم</option>
                                <option value="0">لا</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">اشترك الآن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
