@extends('layouts.app')

@section('title', 'forgot-password')

@section('content')
<main>
  <div class="page-top d-flex justify-content-center align-items-center flex-column text-center">
    <div class="page-top__overlay"></div>
    <div class="position-relative">
      <div class="page-top__title mb-3">
        <h2>نسيت كلمة المرور؟</h2>
      </div>
      <div class="page-top__breadcrumb">
        <a class="text-gray" href="{{ route('home.page') }}">الرئيسية</a> /
        <span class="text-gray">إعادة تعيين كلمة المرور</span>
      </div>
    </div>
  </div>

  <div class="page-full pb-5">
    <div class="account account--forget mt-5 pt-5">
      <p>
        فقدت كلمة المرور الخاصة بك؟ الرجاء إدخال عنوان البريد الإلكتروني
        الخاص بك. ستتلقى رابطًا لإنشاء كلمة مرور جديدة.
      </p>
      <form action="#" method="POST">
        @csrf
        <div class="input-group rounded-1 mb-3">
          <input type="text" class="form-control p-3" name="email" placeholder="البريد الالكتروني" />
          <span class="input-group-text login__input-icon"><i class="fa-solid fa-envelope"></i></span>
        </div>

        <button class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1">
          إعادة تعيين كلمة المرور
        </button>
      </form>
    </div>
  </div>
</main>
@endsection
