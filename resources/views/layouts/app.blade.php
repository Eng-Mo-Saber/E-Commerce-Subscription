<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href={{ asset('assets/images/logo.png') }} type="image/x-icon" />
    <link rel="stylesheet" href={{ asset('assets/css/vendors/all.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/vendors/bootstrap.rtl.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/vendors/owl.carousel.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/vendors/owl.theme.default.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/main.min.css') }}>
</head>

<body>

    <!-- Header Content Start -->
    <div>
        <div class="header-container fixed-top border-bottom">
            <header>
                <div class="section-container d-flex justify-content-between">
                    <div class="header__email d-flex gap-2 align-items-center">
                        <i class="fa-regular fa-envelope"></i>
                        @if (Auth::check())
                            {{ Auth::user()->email }}
                        @else
                            coding.arabic@gmail.com
                        @endif
                    </div>
                    <div class="header__branches d-flex gap-2 align-items-center">
                        <a class="text-white text-decoration-none" href="{{ route('branches.page') }}">
                            <i class="fa-solid fa-location-dot"></i>
                            فروعنا
                        </a>
                    </div>
                </div>
            </header>

            @include('inc.nav')
            <!--app -->
            <div class="nav__categories offcanvas offcanvas-start px-4 py-2" tabindex="-1" id="nav__categories"
                aria-labelledby="nav__categories">
                <div class="nav__categories-header offcanvas-header justify-content-end">
                    <button type="button" class="border-0 bg-transparent text-danger nav__close"
                        data-bs-dismiss="offcanvas" aria-label="Close">
                        <i class="fa-solid fa-x fa-1x fw-light"></i>
                    </button>
                </div>
                <div class="nav__categories-body offcanvas-body pt-0">
                    <div class="nav__side-logo mb-2">
                        <img class="w-100" src="assets/images/logo.png" alt="">
                    </div>
                    <ul class="nav__list list-unstyled">
                        <li class="nav__link nav__side-link"><a href="{{ route('home.page') }}" class="py-3">جميع المنتجات</a></li>
                        @php
                            $categories = App\Models\Category::all();
                        @endphp
                        @foreach ($categories as $category )
                        <li class="nav__link nav__side-link"><a href="{{ route('single-category.page' , $category->id) }}" class="py-3">{{ $category->name }}</a></li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>



        @yield('content')
    </div>
    @include('inc.footer')
    <script src={{ asset('assets/js/vendors/all.min.js') }}></script>
    <script src={{ asset('assets/js/vendors/bootstrap.bundle.min.js') }}></script>
    <script src={{ asset('assets/js/vendors/jquery-3.7.0.js') }}></script>
    <script src={{ asset('assets/js/vendors/owl.carousel.min.js') }}></script>
    <script src={{ asset('assets/js/main.js') }}></script>
    <script src={{ asset('assets/js/app.js') }}></script>
</body>

</html>
