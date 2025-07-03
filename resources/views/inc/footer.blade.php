
  <!-- Footer Section Start -->
  <footer class="footer text-white">
    <div class="footer__upper">
      <div class="section-container row">
        <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
          <div class="footer__logo">
            <img class="w-100" src="assets/images/logo.png" alt="">
          </div>
          <p class="my-3 text-gray">شركتنا هي أكبر شركة متخصصة لبيع الاحذية أونلاين وتوصيلها حتي المنزل.</p>
          <div class="footer__social d-flex gap-3">
            <a href=""><i class="fa-brands fa-facebook fa-2x text-white"></i></a>
            <a href=""><i class="fa-brands fa-instagram fa-2x text-white"></i></a>
            <a href=""><i class="fa-brands fa-tiktok fa-2x text-white"></i></a>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 px-md-4 mb-5 mb-lg-0">
          <div class="footer__list-title fw-bolder mb-1">
            عن Coding arabic
          </div>
          <div class="footer__list list-unstyled p-0">
            <li><a class="footer__link text-decoration-none d-inline-block text-gray py-1" href="{{ route('about.page') }}">من نحن</a></li>
            <li><a class="footer__link text-decoration-none d-inline-block text-gray py-1" href="{{ route('track-order.page') }}">تتبع طلبك</a></li>
            <li><a class="footer__link text-decoration-none d-inline-block text-gray py-1" href="{{ route('contact.page') }}">تواصل معنا</a></li>
            <li><a class="footer__link text-decoration-none d-inline-block text-gray py-1" href="{{ route('privacy-policy.page') }}">سياسة الخصوصية</a></li>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 px-md-4 mb-5 mb-lg-0">
          <div class="footer__list-title fw-bolder mb-1">
            فروعنا
          </div>
          <div class="footer__list">
            <div class="d-flex gap-3 mb-3">
              <div class="fs-5"><i class="fa-solid fa-location-dot"></i></div>
              <div class="text-gray">فرع طنطا: ش بطرس مع سعيد امام المركز الطبى - طنطا.</div>
            </div>
            <div class="d-flex gap-3">
              <div class="fs-5"><i class="fa-solid fa-location-dot"></i></div>
              <div class="text-gray">فرع اسكندرية: ش جمال عبد الناصر - تحت كوبرى 45 - ميامى.</div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
          <div>
            <div class="footer__list-title fw-bolder mb-1">
              تحتاج مساعدة ؟
            </div>
            <div class="d-flex gap-3 mb-3">
              <div class="fs-5"><i class="fa-solid fa-envelope"></i></div>
              <div class="text-gray">coding.arabic@gmail.com</div>
            </div>
          </div>
          <div>
            <div class="footer__list-title fw-bolder mb-3">
              اشترك في نشرتنا
            </div>
            <form class="footer__form position-relative">
              <input
                class="footer__email-input w-100 bg-transparent border border-white py-2 px-3 rounded-2 text-white pe-5"
                placeholder="البريد الالكتروني">
              <button
                class="footer__submit mx-3 position-absolute top-50 translate-middle-y end-0 bg-transparent border-0 text-white d-flex align-items-center"><i
                  class="fa-solid fa-paper-plane"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="footer__bottom text-center p-3 section-container">
      جميع الحقوق محفوظة Eraasoft 2023
    </div>
  </footer>
  <!-- Footer Section End -->