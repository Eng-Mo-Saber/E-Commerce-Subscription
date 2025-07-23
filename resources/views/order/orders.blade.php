@extends('layouts.app')

@section('title', 'Orders')

@section('content')

    <main>
        <section class="page-top d-flex justify-content-center align-items-center flex-column text-center ">
            <div class="page-top__overlay"></div>
            <div class="position-relative">
                <div class="page-top__title mb-3">
                    <h2>حسابي</h2>
                </div>
                <div class="page-top__breadcrumb">
                    <a class="text-gray" href="index.html">الرئيسية</a> /
                    <span class="text-gray">حسابي</span>
                </div>
            </div>
        </section>
        @if (session('success'))
            <div class="d-flex justify-content-center mt-3">
                <div class="alert alert-success w-50 text-center">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <section class="section-container profile my-3 my-md-5 py-5 d-md-flex gap-5">
            <div class="profile__right">
                <div class="profile__user mb-3 d-flex gap-3 align-items-center">
                    <div class="profile__user-img rounded-circle overflow-hidden">
                        <img class="w-100" src="assets/images/user.png" alt="">
                    </div>
                    <div class="profile__user-name">{{ Auth::user()->name }}</div>
                </div>
                <ul class="profile__tabs list-unstyled ps-3">
                    <li class="profile__tab active">
                        <a class="py-2 px-3 text-black text-decoration-none" href="{{ route('profile.page') }}">لوحة
                            التحكم</a>
                    </li>
                    <li class="profile__tab">
                        <a class="py-2 px-3 text-black text-decoration-none"
                            href="{{ route('my-subscription.page') }}">الخدمات المشترك بها</a>
                    </li>
                    <li class="profile__tab">
                        <a class="py-2 px-3 text-black text-decoration-none" href="{{ route('orders.page') }}">الطلبات</a>
                    </li>
                    <li class="profile__tab">
                        <a class="py-2 px-3 text-black text-decoration-none"
                            href="{{ route('account-details.page') }}">تفاصيل الحساب</a>
                    </li>
                    <li class="profile__tab">
                        <a class="py-2 px-3 text-black text-decoration-none"
                            href="{{ route('favorites.page') }}">المفضلة</a>
                    </li>
                    <li class="profile__tab">
                        <a class="py-2 px-3 text-black text-decoration-none" href="{{ route('logout.user') }}">تسجيل
                            الخروج</a>
                    </li>
                </ul>
            </div>
            <div class="profile__left mt-4 mt-md-0 w-100">
                <div class="profile__tab-content orders active">
                    <table class="orders__table w-100">
                        <thead>
                            <th class="d-none d-md-table-cell">الطلب</th>
                            <th class="d-none d-md-table-cell">التاريخ</th>
                            <th class="d-none d-md-table-cell">الحالة</th>
                            <th class="d-none d-md-table-cell">الاجمالي</th>
                            <th class="d-none d-md-table-cell">اجراءات</th>
                        </thead>
                        @php
                            $checkStatus = 1;
                        @endphp
                        @foreach ($orders as $order)
                            @if ($order->status == 'pending' || $order->status == 'shipped')
                                @php
                                    $checkStatus = 0;
                                @endphp
                                <tbody>
                                    <tr class="order__item">
                                        <td class="d-flex justify-content-between d-md-table-cell">
                                            <div class="fw-bolder d-md-none"> رقم الطلب:</div>
                                            <div># {{ $order->id }}</div>
                                        </td>
                                        <td class="d-flex justify-content-between d-md-table-cell">
                                            <div class="fw-bolder d-md-none">التاريخ:</div>
                                            <div>{{ $order->created_at }}</div>
                                        </td>
                                        <td class="d-flex justify-content-between d-md-table-cell">
                                            <div class="fw-bolder d-md-none">الحالة:</div>
                                            @if ($order->status == 'pending')
                                                <div>قيد الانتظار</div>
                                            @else
                                                <div>قيد التنفيذ</div>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-between d-md-table-cell">
                                            <div class="fw-bolder d-md-none">الاجمالي:</div>
                                            <div>{{ $order->total_price }} EGP</div>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a class="btn btn-primary" href="{{ route('order-details.page' , $order->id) }}">عرض</a>
                                                @if ($order->status == 'pending')
                                                    <a class="btn btn-danger" href="{{ route('orders.destroy' , $order->id) }}">الغاء الطلب</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            @endif
                        @endforeach
                    </table>
                    @if ($checkStatus)
                        <div class="orders__none d-flex justify-content-between align-items-center py-3 px-4">
                            <p class="m-0">لم يتم تنفيذ اي طلب بعد.</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>

@endsection
