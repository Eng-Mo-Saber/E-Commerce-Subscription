@extends('layouts.app')

@section('title', 'Services')


@section('content')
<div class="container py-5" style="margin-top: 100px;">
    <h2 class="text-center mb-4">الخدمات المتاحة</h2>
    <div class="row">
        @foreach ($services as $service)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <h4 class="card-title text-primary fw-bold">{{ $service->name }}</h4>
                        <p class="card-text text-muted mb-3">عرض الاشتراكات في الخدمة</p>
                        <a href="{{ route('subscription.page', $service->id) }}" class="btn btn-success mt-auto">عرض</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

