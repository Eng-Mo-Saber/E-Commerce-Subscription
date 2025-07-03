@extends('layouts.app')

@section('title', 'checkout')

@section('content')
    <main>
        <section class="page-top d-flex justify-content-center align-items-center flex-column text-center">
            <div class="page-top__overlay"></div>
            <div class="position-relative">
                <div class="page-top__title mb-3">
                    <h2>إتمام الطلب</h2>
                </div>
                <div class="page-top__breadcrumb">
                    <a class="text-gray" href="{{ route('home.page') }}">الرئيسية</a> /
                    <span class="text-gray">إتمام الطلب</span>
                </div>
            </div>
        </section>

        <section class="section-container my-5 py-5 d-lg-flex">
            <div class="checkout__form-cont w-50 px-3 mb-5">
                <h4>الفاتورة </h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="checkout__form" action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="last-name">العنوان بالكامل ( المحافظه - المركز - المنطقة -الشارع - رقم المنزل)<span
                                class="required">*</span></label>
                        <input class="form__input" placeholder="العنوان بالكامل" name="address" type="text"
                            id="last-name" />
                    </div>
                    <div class="mb-3">
                        <h2>معلومات اضافية</h2>
                        <label for="last-name">ملاحظات الطلب (اختياري)<span class="required">*</span></label>
                        <textarea class="form__input" placeholder="ملاحظات حول الطلب, مثال: ملحوظة خاصة بتسليم الطلب." type="text"
                            id="last-name" name="notes"></textarea>
                    </div>
                    <button class="primary-button w-100 py-2">تاكيد الطلب</button>
                </form>
            </div>
            <div class="checkout__order-details-cont w-50 px-3">
                <h4>طلبك</h4>
                <div>
                    <table class="w-100 checkout__table">
                        <thead>
                            <tr class="border-0">
                                <th>المنتج</th>
                                <th>السعر</th>
                                <th>الكمية</th>
                                <th>المجموع</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($carts as $cart)
                                <tr>
                                    <td>{{ $cart->product->name }}</td>
                                    <td>{{ $cart->product->price }}</td>
                                    <td>{{ $cart->quantity }}</td>
                                    <td>
                                        <div class="product__price text-center d-flex gap- flex-wrap">
                                            <span class="product__price"> {{ $cart->price * $cart->quantity }} جنيه </span>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $total += $cart->price * $cart->quantity;
                                @endphp
                            @endforeach
                            <tr class="table-success">
                                <th class="text-end fs-5">المجموع</th>
                                <td class="fw-bold text-success fs-5">{{ $total }} جنيه</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="checkout__payment py-3 px-4 mb-3">
                    <p class="m-0 fw-bolder">الدفع نقدا عند الاستلام</p>
                </div>

                <p>الدفع عند التسليم مباشرة.</p>
            </div>
        </section>
    </main>

@endsection
