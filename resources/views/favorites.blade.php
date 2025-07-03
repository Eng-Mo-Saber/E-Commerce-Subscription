@extends('layouts.app')

@section('title', 'favorites')

@section('content')
    <main>
        <div class="page-top d-flex justify-content-center align-items-center flex-column text-center">
            <div class="page-top__overlay"></div>
            <div class="position-relative">
                <div class="page-top__title mb-3">
                    <h2>المفضلة</h2>
                </div>
                <div class="page-top__breadcrumb">
                    <a class="text-gray" href="{{ route('home.page') }}">الرئيسية</a> /
                    <span class="text-gray">المفضلة</span>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="d-flex justify-content-center mt-3">
                <div class="alert alert-success w-50 text-center">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="my-5 py-5">
            <section class="section-container favourites">
                <table class="w-100">
                    <thead>
                        <th class="d-none d-md-table-cell"></th>
                        <th class="d-none d-md-table-cell"></th>
                        <th class="d-none d-md-table-cell">الاسم</th>
                        <th class="d-none d-md-table-cell">السعر</th>
                        <th class="d-none d-md-table-cell">تاريخ الاضافه</th>
                        <th class="d-none d-md-table-cell">المخزون</th>
                        <th class="d-table-cell d-md-none">product</th>
                    </thead>
                    @foreach ($favorites as $favorite)
                        <tbody class="text-center">
                            <tr>

                                <td class="d-block d-md-table-cell text-center">
                                    <a href="{{ route('Remove-favorites.page', $favorite->id) }}" class="text-danger fs-5"
                                        title="إزالة من المفضلة">
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                </td>

                                <td class="d-block d-md-table-cell favourites__img">
                                    <img src="{{ asset('storage/' . $favorite->product->image) }}" alt="" />
                                </td>
                                <td class="d-block d-md-table-cell">
                                    <a href="{{ route('single-product.page', $favorite->product->id) }}">
                                        {{ $favorite->product->name }} </a>
                                </td>
                                <td class="d-block d-md-table-cell">

                                    <span class="product__price">{{ $favorite->product->price }} جنية</span>
                                </td>
                                <td class="d-block d-md-table-cell">{{ $favorite->product->created_at->format('Y-m-d') }}
                                </td>
                                </td>
                                <td class="d-block d-md-table-cell">
                                    <span class="me-2"><i class="fa-solid fa-check"></i></span>
                                    @if ($favorite->product->stock_quantity == 0)
                                        <span class="d-inline-block d-md-none d-lg-inline-block">غير متوفر الان بالمخزون
                                        </span>
                                    @else
                                        <span class="d-inline-block d-md-none d-lg-inline-block">متوفر بالمخزون</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </section>
        </div>
    </main>

@endsection
