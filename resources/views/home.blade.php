@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Page Content Start -->
    <main class="pt-4">
        @if (session('success'))
            <div class="d-flex justify-content-center mt-3">
                <div class="alert alert-success w-50 text-center">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Hero Section Start -->
        <section class="section-container hero">
            <div class="owl-carousel hero__carousel owl-theme">
                <div class="hero__item">
                    <img class="hero__img" src="{{ asset('assets/images/carousel-2.png') }}" alt="">
                </div>
                <div class="hero__item">
                    <img class="hero__img" src="{{ asset('assets/images/carousel-2.png') }}" alt="">
                </div>
                <div class="hero__item">
                    <img class="hero__img" src="{{ asset('assets/images/carousel-2.png') }}" alt="">
                </div>
            </div>
        </section>
        <!-- Hero Section End -->

        <!-- Offer Section End -->

        <!-- Products Section Start -->
        <section class="section-container mb-4">
            <div class="products__header mb-4 text-center">
                <h4 class="m-0 fw-bold text-white bg-success  d-inline-block px-4 py-2 rounded">
                    وصـــل حديـــثا
                </h4>
            </div>

            <div class="owl-carousel products__slider owl-theme">
                @foreach ($products_new as $product_new)
                    <div class="products__item">
                        <div class="product__header mb-3 position-relative">
                            @auth
                                <a href="{{ route('single-product.page', $product_new->id) }}">
                                @endauth
                                <div class="product__img-cont">
                                    <img class="product__img w-100 h-100 object-fit-cover"
                                        src="{{ asset('storage/' . $product_new->image) }}" data-id="white">
                                </div>
                            </a>
                            @auth

                                {{-- زرار الفيفوريت --}}
                                <a href="{{ route('Add-favorites.page', $product_new->id) }}"
                                    class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white p-2"
                                    title="أضف إلى المفضلة">
                                    @if (in_array($product_new->id, $favProductIds ?? []))
                                        <i class="fa-solid fa-heart text-danger"></i>
                                    @else
                                        <i class="fa-regular fa-heart text-danger"></i>
                                    @endif
                                </a>
                            @endauth

                        </div>
                        @auth

                            <div class="product__title text-center">
                                <a class="text-black text-decoration-none"
                                    href="{{ route('single-product.page', $product_new->id) }}">
                                    {{ $product_new->name }}
                                </a>
                            </div>
                        @endauth

                        <div class="product__author text-center">
                            {{ $product_new->author }}
                        </div>

                        <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
                            <span class="product__price">
                                {{ $product_new->price }} جنيه
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- Products Section End -->

        <!-- Categories Section Start -->
        <section class="section-container mb-5">
            <div class="categories row gx-4">
                <div class="col-md-6 p-2">
                    <div class="p-4 border rounded-3">
                        <img class="w-100" src="assets/images/category-1.png" alt="">
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="p-4 border rounded-3">
                        <img class="w-100" src="assets/images/category-2.png" alt="">
                    </div>
                </div>
            </div>
        </section>
        <!-- Categories Section End -->

        <!-- Best Sales Section Start -->
        <section class="section-container mb-5">
            <div class="products__header mb-4 text-center">
                <h4 class="m-0 fw-bold text-white bg-success  d-inline-block px-4 py-2 rounded">
                    الـــكـــــل
                </h4>
            </div>

            <div class="owl-carousel products__slider owl-theme">
                @foreach ($products as $product)
                    <div class="products__item">
                        <div class="product__header mb-3">
                            @auth
                                <a href="{{ route('single-product.page', $product->id) }}">
                                @endauth
                                <div class="product__img-cont">
                                    <img class="product__img w-100 h-100 object-fit-cover"
                                        src="{{ asset('storage/' . $product->image) }}" data-id="white">
                                </div>
                            </a>
                            @auth

                                {{-- زرار الفيفوريت --}}
                                <a href="{{ route('Add-favorites.page', $product->id) }}"
                                    class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white p-2"
                                    title="أضف إلى المفضلة">
                                    @if (in_array($product->id, $favProductIds ?? []))
                                        <i class="fa-solid fa-heart text-danger"></i>
                                    @else
                                        <i class="fa-regular fa-heart text-danger"></i>
                                    @endif
                                </a>
                            @endauth
                        </div>
                        @auth
                            <div class="product__title text-center">
                                <a class="text-black text-decoration-none"
                                    href="{{ route('single-product.page', $product->id) }}">
                                    {{ $product->name }}
                                </a>
                            </div>
                        @endauth
                        <div class="product__author text-center">
                            {{ $product->author }}
                        </div>
                        <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
                            <span class="product__price">
                                {{ $product->price }} جنيه
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- Best Sales Section End -->

    </main>
    <!-- Page Content End -->
@endsection
