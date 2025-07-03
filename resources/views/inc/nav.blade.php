      <!--   nav -->
      <nav class="nav">
          <div class="section-container w-100 d-flex align-items-center gap-4 h-100">
              <div class="nav__categories-btn align-items-center justify-content-center rounded-1 d-none d-lg-flex">
                  <button class="border-0 bg-transparent" data-bs-toggle="offcanvas" data-bs-target="#nav__categories">
                      <i class="fa-solid fa-align-center fa-rotate-180"></i>
                  </button>
              </div>
              <div class="nav__logo">
                  <a href="{{ route('home.page') }}">
                      <img class="h-100" src="{{ asset('assets/images/logo.png') }}" alt="">
                  </a>
              </div>
              <div class="nav__search w-100">
                  <input class="nav__search-input w-100" type="search" placeholder="أبحث هنا عن اي شئ تريده...">
                  <span class="nav__search-icon">
                      <i class="fa-solid fa-magnifying-glass"></i>
                  </span>
              </div>

              <ul class="nav__links gap-3 list-unstyled d-none d-lg-flex m-0">
                  @auth

                      <li class="nav__link nav__link-user">
                          <a class="d-flex align-items-center gap-2">
                              حسابي
                              <i class="fa-regular fa-user"></i>
                              <i class="fa-solid fa-chevron-down fa-2xs"></i>
                          </a>
                          <ul class="nav__user-list position-absolute p-0 list-unstyled bg-white">
                              <li class="nav__link nav__user-link"><a href="{{ route('profile.page') }}">لوحة التحكم</a>
                              </li>
                              <li class="nav__link nav__user-link"><a href="{{ route('orders.page') }}">الطلبات</a></li>
                              <li class="nav__link nav__user-link"><a href="{{ route('account-details.page') }}">تفاصيل
                                      الحساب</a></li>
                              <li class="nav__link nav__user-link"><a href="{{ route('favorites.page') }}">المفضلة</a></li>
                              <li class="nav__link nav__user-link"><a href="{{ route('logout.user') }}">تسجيل الخروج</a>
                              </li>
                          </ul>
                      </li>
                  @endauth
                  @guest
                      <li class="nav__link nav__link-user">
                          <a class="d-flex align-items-center gap-2">
                              تسجيل الدخول
                              <i class="fa-regular fa-user"></i>
                              <i class="fa-solid fa-chevron-down fa-2xs"></i>
                          </a>
                          <ul class="nav__user-list position-absolute p-0 list-unstyled bg-white">
                              <li class="nav__link nav__user-link"><a href="{{ route('register.page') }}">ٌحساب جديد</a>
                              </li>
                              <li class="nav__link nav__user-link"><a href="{{ route('login.page') }}">تسجيل الدخول</a></li>
                          </ul>
                      </li>
                  @endguest
                  @auth
                      <li class="nav__link">
                          <a class="d-flex align-items-center gap-2" href="{{ route('home.page') }}">
                              Home
                              <div class="position-relative">
                                  <i class="fa-solid fa-house"></i>
                              </div>
                          </a>
                      </li>
                      @if (Auth::user()->role == 'admin')
                          <li class="nav__link">
                              <a class="d-flex align-items-center gap-2" href="{{ route('page.dashboard') }}">
                                  Dashboard
                                  <div class="position-relative">
                                      <i class="fa-solid fa-gauge"></i>
                                  </div>
                              </a>
                          </li>
                      @endif

                      <li class="nav__link">
                          <a class="d-flex align-items-center gap-2" href="{{ route('service.page') }}">
                              Services
                              <div class="position-relative">
                                  <i class="fa-solid fa-concierge-bell"></i>
                              </div>
                          </a>
                      </li>
                      <li class="nav__link">
                          <a class="d-flex align-items-center gap-2" href="{{ route('my-subscription.page') }}">
                              My subscriptions
                              <div class="position-relative">
                                  <i class="fa-solid fa-book-bookmark"></i>
                              </div>
                          </a>
                      </li>
                      <li class="nav__link">
                          <a class="d-flex align-items-center gap-2" href="{{ route('favorites.page') }}">
                              المفضلة
                              <div class="position-relative">
                                  <i class="fa-regular fa-heart"></i>
                                  <div class="nav__link-floating-icon">
                                      {{ App\Models\Favorite::where('user_id', Auth::user()->id)->count() }}
                                  </div>
                              </div>
                          </a>
                      </li>
                      <li class="nav__link">
                          <a class="d-flex align-items-center gap-2" href="{{ route('cart.page') }}">
                              عربة التسوق
                              <div class="position-relative">
                                  <i class="fa-solid fa-cart-shopping"></i>
                                  <div class="nav__link-floating-icon">
                                      {{ App\Models\Cart::where('user_id', Auth::user()->id)->count() }}
                                  </div>
                              </div>
                          </a>
                      </li>

                  @endauth

              </ul>
          </div>
          <div class="nav-mobile fixed-bottom d-block d-lg-none">
              <ul class="nav-mobile__list d-flex justify-content-around gap-2 list-unstyled  m-0 border-top">
                  <li class="nav-mobile__link">
                      <a class="d-flex align-items-center flex-column gap-1 text-decoration-none"
                          href="{{ route('home.page') }}">
                          <i class="fa-solid fa-house"></i>
                          الرئيسية
                      </a>
                  </li>
                  <li class="nav-mobile__link d-flex align-items-center flex-column gap-1" data-bs-toggle="offcanvas"
                      data-bs-target="#nav__categories">
                      <i class="fa-solid fa-align-center fa-rotate-180"></i>
                      الاقسام
                  </li>
                  @auth

                      <li class="nav-mobile__link d-flex align-items-center flex-column gap-1">
                          <a class="d-flex align-items-center flex-column gap-1 text-decoration-none"
                              href="{{ route('profile.page') }}">
                              <i class="fa-regular fa-user"></i>
                              حسابي
                          </a>
                      </li>
                      <li class="nav-mobile__link d-flex align-items-center flex-column gap-1">
                          <a class="d-flex align-items-center flex-column gap-1 text-decoration-none"
                              href="{{ route('favorites.page') }}">
                              <i class="fa-regular fa-heart"></i>
                              المفضلة
                          </a>
                      </li>
                  @endauth

                  <li class="nav-mobile__link d-flex align-items-center flex-column gap-1" data-bs-toggle="offcanvas"
                      data-bs-target="#nav__cart">
                      <i class="fa-solid fa-cart-shopping"></i>
                      السلة
                  </li>
              </ul>
              <!--  -->
          </div>
      </nav>
