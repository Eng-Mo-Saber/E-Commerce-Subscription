@extends('layouts.app')

@section('title', 'Track Order')

@section('content')
    <main>
        <section class="page-top d-flex justify-content-center align-items-center flex-column text-center">
            <div class="page-top__overlay"></div>
            <div class="position-relative">
                <div class="page-top__title mb-3">
                    <h2>تتبع طلبك</h2>
                </div>
                <div class="page-top__breadcrumb">
                    <a class="text-gray" href="{{ route('home.page') }}">الرئيسية</a> /
                    <span class="text-gray">تتبع طلبك</span>
                </div>
            </div>
        </section>
        @if (session('success'))
            <div class="d-flex justify-content-center mt-3">
                <div class="alert alert-success w-40 text-center">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="d-flex justify-content-center mt-3">
                <div class="alert alert-danger w-40 text-center">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        <section class="section-container my-5 py-5">
            <p class="mb-5">فضلًا أدخل رقم طلبك في الصندوق أدناه وأضغط زر لتتبعه "تتبع الطلب" لعرض حالته. بإمكانك العثور
                على رقم الطلب في البريد المرسل إليك والذي يحتوي على فاتورة تأكيد الطلب.</p>
            <form action="{{ route('track-status-order') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="">رقم الطلب</label>
                    <input class="form__input" name="id" placeholder="ستجده في رسالة تأكيد طلبك." type="text">
                </div>
                <button class="primary-button">تتبع طلبك</button>
            </form>
        </section>
    </main>
@endsection
