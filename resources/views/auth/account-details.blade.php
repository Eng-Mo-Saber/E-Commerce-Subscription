@extends('layouts.app')

@section('title', 'Account Details')

@section('content')
    <main>
        <section class="page-top d-flex justify-content-center align-items-center flex-column text-center">
            <div class="page-top__overlay"></div>
            <div class="position-relative">
                <div class="page-top__title mb-3">
                    <h2>حسابي</h2>
                </div>
                <div class="page-top__breadcrumb">
                    <a class="text-gray" href="{{ route('home.page') }}">الرئيسية</a> /
                    <span class="text-gray">حسابي</span>
                </div>
            </div>
        </section>

        <section class="section-container profile my-3 my-md-5 py-5 d-md-flex gap-5">
            <div class="profile__right">
                <div class="profile__user mb-3 d-flex gap-3 align-items-center">
                    <div class="profile__user-img rounded-circle overflow-hidden">
                        <img class="w-100" src="assets/images/user.png" alt="" />
                    </div>
                    <div class="profile__user-name">moamenyt</div>
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
                <div class="profile__tab-content active">
                    <form class="profile__form border p-3" action="">
                        <div class="d-flex gap-3 mb-3">
                            <div class="w-100">
                                <label class="fw-bold mb-2" for="first-name">
                                    الاسم <span class="required">*</span>
                                </label>
                                <input type="text" value="{{ $user->name }}" class="form__input" id="name"
                                    name="name" />
                            </div>
                            <div class="w-100">
                                <label class="fw-bold mb-2" for="last-name">
                                    رقم الهاتف<span class="required">*</span>
                                </label>
                                <input type="number" value="{{ $user->phone }}" class="form__input" id="phone"
                                    name="phone" />
                            </div>
                        </div>
                        <div class="w-100">
                            <label class="fw-bold mb-2" for="displayed-name">
                                البريد الالكتروني<span class="required">*</span>
                            </label>
                            <input type="email" value="{{ $user->email }}" class="form__input" id="email"
                                name="email" />
                        </div>
                        <div class="w-100 mb-3">
                            <label class="fw-bold mb-2" for="email">
                                العنوان<span class="required">*</span>
                            </label>
                            <input type="text" value="{{ $user->address }}" class="form__input" id="address"
                                name="address" />
                        </div>
                        <button class="primary-button">تعديل</button>
                    </form>
                    <form>
                        <fieldset>
                            <legend class="fw-bolder">تغيير كلمة المرور</legend>
                            <div class="w-100 mb-3">
                                <label class="fw-bold mb-2" for="curr-password">
                                    كلمة المرور الحالية (اترك الحقل فارغاً إذا كنت لا تودّ
                                    تغييرها)
                                </label>
                                <input type="text" class="form__input" id="curr-password" />
                            </div>
                            <div class="w-100 mb-3">
                                <label class="fw-bold mb-2" for="curr-password">
                                    كلمة المرور الجديدة (اترك الحقل فارغاً إذا كنت لا تودّ
                                    تغييرها)
                                </label>
                                <input type="text" class="form__input" id="curr-password" />
                            </div>
                            <div class="w-100 mb-3">
                                <label class="fw-bold mb-2" for="curr-password">
                                    تأكيد كلمة المرور الجديدة
                                </label>
                                <input type="text" class="form__input" id="curr-password" />
                            </div>
                            <button class="primary-button">تغيير كلمة المرور</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </section>
    </main>

@endsection
