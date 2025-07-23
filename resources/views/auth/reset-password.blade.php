@extends('layouts.app')

@section('title', 'Reset Password')

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
                    <span class="text-gray">إعادة تعيين كلمة السر</span>
                </div>
            </div>
        </div>

        <div class="page-full pb-5">
            <div class="account account--login mt-5 pt-5">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('reset.request') }}" method="POST" class="mb-5">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}" />
                    @error('password')
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <li>{{ $message }}</li>
                            </ul>
                        </div>
                    @enderror
                    <div class="input-group rounded-1 mb-3">
                        <input type="password" name="password" class="form-control p-3" placeholder="كلمة السر" />
                        <span class="input-group-text login__input-icon"><i class="fa-solid fa-key"></i></span>
                    </div>
                    @error('confirm_password')
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <li>{{ $message }}</li>
                            </ul>
                        </div>
                    @enderror
                    <div class="input-group rounded-1 mb-3">
                        <input type="password" name="confirm_password" class="form-control p-3" placeholder="تأكيد كلمة السر " />
                        <span class="input-group-text login__input-icon"><i class="fa-solid fa-key"></i></span>
                    </div>

                    <button class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1">
                        إعادة تعيين كلمة السر 
                    </button>
                </form>
            </div>
        </div>
    </main>

@endsection
