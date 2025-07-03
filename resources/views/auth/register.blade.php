@extends('layouts.app')

@section('title', 'register')

@section('content')

    <main>
        <div class="page-top d-flex justify-content-center align-items-center flex-column text-center">
            <div class="page-top__overlay"></div>
            <div class="position-relative">
                <div class="page-top__title mb-3">
                    <h2>حسابي</h2>
                </div>
                <div class="page-top__breadcrumb">
                    <a class="text-gray" href="{{ route('home.page') }}">الرئيسية</a> /
                    <span class="text-gray">حساب جديد</span>
                </div>
            </div>
        </div>

        <div class="page-full pb-5">
            <div class="account account--register mt-5 pt-5">
                <form method ="POST" action="{{ route('register.store') }}" class="mb-5">
                    @csrf
                    @error('name')
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <li>{{ $message  }}</li>
                            </ul>
                        </div>
                    @enderror
                    <div class="input-group rounded-1 mb-3">
                        <input type="text" class="form-control p-3" name="name" placeholder="الاسم كامل" />
                        <span class="input-group-text login__input-icon"><i class="fa-solid fa-user"></i></span>
                    </div>
                    @error('email')
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <li>{{ $message  }}</li>
                            </ul>
                        </div>
                    @enderror
                    <div class="input-group rounded-1 mb-3">
                        <input type="text" class="form-control p-3" name="email" placeholder="البريد الالكتروني" />
                        <span class="input-group-text login__input-icon"><i class="fa-solid fa-envelope"></i></span>
                    </div>
                    @error('phone')
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <li>{{ $message  }}</li>
                            </ul>
                        </div>
                    @enderror
                    <div class="input-group rounded-1 mb-3">
                        <input type="text" class="form-control p-3" name="phone" placeholder="رقم الهاتف" />
                        <span class="input-group-text login__input-icon"><i class="fa-solid fa-phone"></i></span>
                    </div>
                    @error('address')
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <li>{{ $message  }}</li>
                            </ul>
                        </div>
                    @enderror
                    <div class="input-group rounded-1 mb-3">
                        <input type="text" class="form-control p-3" name="address" placeholder="العنوان" />
                        <span class="input-group-text login__input-icon"><i class="fa-solid fa-map-marker-alt"></i></span>
                    </div>
                    @error('password')
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <li>{{ $message  }}</li>
                            </ul>
                        </div>
                    @enderror
                    <div class="input-group rounded-1 mb-3">
                        <input type="password" class="form-control p-3" name="password" placeholder="كلمة السر" />
                        <span class="input-group-text login__input-icon"><i class="fa-solid fa-key"></i></span>
                    </div>
                    <button class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1">
                        حساب جديد
                    </button>
                </form>
            </div>
        </div>
    </main>

@endsection
