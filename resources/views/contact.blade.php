@extends('layouts.app')

@section('title', 'contact')

@section('content')
    <!-- Account Modal Start -->
    <div class="account__modal modal" id="account__modal"  data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <button type="button" class="btn-close position-absolute top-0 start-0 modal__close-btn d-flex justify-content-center align-items-center opacity-100 rounded-circle bg-white" data-bs-dismiss="modal">
            <i class="fa-regular fa-circle-xmark"></i>
          </button>
          <div class="modal-body h-100 p-0 d-flex">
            <div class="px-5 pt-5 account__modal-forms">
              <div class="account account--login w-100 mb-5">
                <div class="account__tabs w-100 d-flex mb-3">
                  <div class="account__tab account__tab--login text-center fs-6 py-3 w-50">تسجيل الدخول</div>
                  <div class="account__tab account__tab--register text-center fs-6 py-3 w-50">حساب جديد</div>
                </div>
                <div class="account__login w-100">
                  <form class="mb-5">
                    <div class="input-group rounded-1 mb-3">
                      <input type="text" class="form-control p-3" placeholder="البريد الالكتروني" aria-label="email" aria-describedby="basic-addon1">
                      <span class="input-group-text login__input-icon" id="basic-addon1">
                        <i class="fa-solid fa-envelope"></i>
                      </span>
                    </div>
                    <div class="input-group rounded-1 mb-3">
                      <input type="password" class="form-control p-3" placeholder="كلمة السر" aria-label="password" aria-describedby="basic-addon1">
                      <span class="input-group-text login__input-icon" id="basic-addon1">
                        <i class="fa-solid fa-key"></i>
                      </span>
                    </div>
                    <div class="login__bottom d-flex justify-content-between mb-3">
                      <a class="login__forget-btn" href="">نسيت كلمة المرور؟</a>
                      <div>
                        <input type="checkbox">
                        <label for="">تذكرني</label>
                      </div>
                    </div>
                    <button class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1">تسجيل الدخول</button>
                  </form>
                  <div class="account__external">
                    <div class="account__external-header position-relative">
                      <div class="account__external-text bg-white px-3 fs-6 fw-bolder position-absolute top-50 start-50 translate-middle">
                        او سجل الدخول باستخدام
                      </div>
                    </div>
                    <div class="d-flex justify-content-center flex-wrap gap-2 mt-5">
                      <div class="account__external-google bg-danger px-4 py-2 text-white">
                        Google
                        <i class="fa-brands fa-google"></i>
                      </div>
                      <div class="account__external-facebook px-4 py-2 text-white">
                        Facebook
                        <i class="fa-brands fa-square-facebook"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="account__register w-100">
                  <form class="mb-5">
                    <div class="input-group rounded-1 mb-3">
                      <input type="text" class="form-control p-3" placeholder="الاسم كامل" aria-label="Username" aria-describedby="basic-addon1">
                      <span class="input-group-text login__input-icon" id="basic-addon1">
                        <i class="fa-solid fa-user"></i>
                      </span>
                    </div>
                    <div class="input-group rounded-1 mb-3">
                      <input type="text" class="form-control p-3" placeholder="البريد الالكتروني" aria-label="email" aria-describedby="basic-addon1">
                      <span class="input-group-text login__input-icon" id="basic-addon1">
                        <i class="fa-solid fa-envelope"></i>
                      </span>
                    </div>
                    <div class="input-group rounded-1 mb-3">
                      <input type="password" class="form-control p-3" placeholder="كلمة السر" aria-label="password" aria-describedby="basic-addon1">
                      <span class="input-group-text login__input-icon" id="basic-addon1">
                        <i class="fa-solid fa-key"></i>
                      </span>
                    </div>
          
                    <button class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1">حساب جديد</button>
                  </form>
          
                  <div class="account__external">
                    <div class="account__external-header position-relative">
                      <div class="account__external-text bg-white px-3 fs-5 fw-bolder position-absolute top-50 start-50 translate-middle">
                        او سجل باستخدام
                      </div>
                    </div>
                    <div class="d-flex justify-content-center flex-wrap gap-2 mt-5">
                      <div class="account__external-google bg-danger px-4 py-2 text-white">
                        Google
                        <i class="fa-brands fa-google"></i>
                      </div>
                      <div class="account__external-facebook px-4 py-2 text-white">
                        Facebook
                        <i class="fa-brands fa-square-facebook"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="account__forget">
                  <p>فقدت كلمة المرور الخاصة بك؟ الرجاء إدخال عنوان البريد الإلكتروني الخاص بك. ستتلقى رابطا لإنشاء كلمة مرور جديدة عبر البريد الإلكتروني.</p>
                  <form action="">
                    <div class="input-group rounded-1 mb-3">
                      <input type="text" class="form-control p-3" placeholder="البريد الالكتروني" aria-label="Username" aria-describedby="basic-addon1">
                      <span class="input-group-text login__input-icon" id="basic-addon1">
                        <i class="fa-solid fa-envelope"></i>
                      </span>
                    </div>
                    <button class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1">اعادة تعيين كلمة المرور</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Account Modal End -->
@endsection