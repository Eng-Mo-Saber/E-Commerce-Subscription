@extends('layouts.app')

@section('title', 'Single Product')

@section('content')
    <main>
        <!-- Product details Start -->
        <section class="section-container my-5 pt-5 d-md-flex gap-5">
            <div class="single-product__img w-100" id="main-img">
                <img src="{{ asset('storage/' . $product->image) }}" alt="">
            </div>
            <div class="single-product__details w-100 d-flex flex-column justify-content-between">
                <div>
                    <h4>{{ $product->name }}</h4>
                    <div class="product__author">{{ $product->author }}</div>
                    <div class="product__price mb-3 text-center d-flex gap-2">
                        <span class="product__price fs-5">
                            {{ $product->price }} جنيه
                        </span>
                    </div>
                    <form action="{{ route('cart.store', $product->id) }}" method="POST">
                        @csrf
                        <div class="d-flex w-100 gap-2 mb-3">
                            <div class="single-product__quanitity position-relative">
                                <input class="single-product__input text-center px-3" name="quantity" type="number"
                                     min="1" placeholder="---">
                            </div>
                            <button type="submit" class="single-product__add-to-cart primary-button w-100">اضافه الي
                                السلة</button>
                        </div>
                    </form>

                </div>
                <div class="single-product__categories">
                    <p class="mb-0">رمز المنتج: غير محدد</p>
                    <div>
                        <span>التصنيفات: </span><a
                            href="{{ route('shop.page', $product->category) }}">{{ $product->category->name }}</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product details End -->


        <div class="book-access-options mt-4"> {{-- تم إضافة بعض الهامش العلوي للمسافة --}}
            <h2 class="text-center mb-4 fw-bold text-primary fs-3">الاشتراك الخاص بك</h2>

            {{-- قسم تحميل/قراءة PDF --}}
            <div class="book-access-options mt-4 mx-auto" style="max-width: 600px;"> {{-- max-width يحدد العرض الأقصى، و mx-auto يضعها في المنتصف --}}

                {{-- قسم تحميل/قراءة PDF --}}

                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">قراءة أو تحميل الكتاب</h5> {{-- h5 أصغر قليلاً --}}
                    </div>
                    <div class="card-body text-center"> {{-- text-center لوسط الأزرار --}}
                        @if (isset($product->book_file) && $product->book_file)
                            @if ($typeSubDownload == 'download' && $userSubsDownloadStatus == 'active')
                                <a href="{{ asset('storage/' . $product->book_file) }}" class="btn btn-primary btn-sm me-2"
                                    download> {{-- btn-sm لأزرار أصغر --}}
                                    <i class="fas fa-file-pdf"></i> تحميل PDF
                                </a>
                            @endif

                            @if ($typeSubReading == 'reading' && $userSubsReadingStatus == 'active')
                                <a href="{{ asset('storage/Products-book-file/' . $product->book_file) }}"
                                    class="btn btn-outline-secondary btn-sm" target="_blank">
                                    <i class="fas fa-book-reader"></i> قراءة عبر المتصفح
                                </a>
                            @endif
                        @else
                            <p class="small text-muted mb-0">لا يوجد من هذا الكتاب نسخة PDF متوفرة حالياً.</p>
                        @endif
                    </div>
                </div>

                {{-- قسم تشغيل الكتاب الصوتي --}}
                @if ($typeSubAudio == 'audio' && $userSubsAudioStatus == 'active')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">الاستماع إلى الكتاب الصوتي</h5>
                        </div>
                        <div class="card-body">
                            @if (isset($product->audio_file) && $product->audio_file)
                                <audio controls class="w-100">
                                    <source src="{{ asset('storage/' . $product->audio_file) }}" type="audio/mpeg">
                                    متصفحك لا يدعم تشغيل الملفات الصوتية.
                                </audio>
                            @else
                                <p class="small text-muted mb-0">عذراً، لا تتوفر نسخة صوتية لهذا الكتاب حالياً.</p>
                            @endif
                        </div>
                    </div>
                @endif



            </div>

        </div>

        </div>

        <!-- Description and questions Start -->
        <section class="section-container">
            <nav class="mb-0 ">
                <div class="nav nav-tabs single-product__nav pb-0 gap-2" id="nav-tab" role="tablist">
                    <button class="single-product__tab nav-link active" id="single-product__describtion-tab"
                        data-bs-toggle="tab" data-bs-target="#nav-description" type="button" role="tab"
                        aria-controls="nav-home" aria-selected="true">
                        الوصف
                    </button>
                    <button class="single-product__tab nav-link" id="single-product__questions-tab" data-bs-toggle="tab"
                        data-bs-target="#single-product__questions" type="button" role="tab"
                        aria-controls="nav-profile" aria-selected="false">
                        الاسئلة الشائعة
                    </button>
                </div>
            </nav>
            <div class="tab-content pt-4" id="nav-tabContent">
                <div class="tab-pane show active" id="nav-description" role="tabpanel"
                    aria-labelledby="single-product__describtion-tab" tabindex="0">
                    {{ $product->description }}
                </div>
                <div class="questions tab-pane" id="single-product__questions" role="tabpanel"
                    aria-labelledby="single-product__questions-tab" tabindex="0">
                    <div class="questions__list accordion" id="question__list">
                        <div class="questions__item accordion-item">
                            <h2 class="questions__header accordion-header" id="question1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    الشحن بيوصل خلال قد ايه؟
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="question1"
                                data-bs-parent="#question__list">
                                <div class="accordion-body">
                                    خلال 3 ايام داخل القاهرة والجيزة و7 ايام خارج القاهرة والجيزة.
                                </div>
                            </div>
                        </div>
                        <div class="questions__item accordion-item">
                            <h2 class="questions__header accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    خامات التصنيع؟
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#question__list">
                                <div class="accordion-body">
                                    خامات مصرية عالية الجودة.
                                </div>
                            </div>
                        </div>
                        <div class="questions__item accordion-item">
                            <h2 class="questions__header accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    متاح استبدال او استرجاع المنتج
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#question__list">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Description and questions End -->

        <!-- Features Start -->
        <section class="section-container py-5">
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="features__item d-flex align-items-center gap-2">
                        <div class="features__img">
                            <img class="w-100" src="assets/images/feature-1.png" alt="">
                        </div>
                        <div>
                            <h6 class="features__item-title m-0">شحن سريع</h6>
                            <p class="features__item-text m-0">سعر شحن موحد لجميع المحافظات ويصلك في أقل من 72 ساعة</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="features__item d-flex align-items-center gap-2">
                        <div class="features__img">
                            <img class="w-100" src="assets/images/feature-2.png" alt="">
                        </div>
                        <div>
                            <h6 class="features__item-title m-0">ضمان الجودة</h6>
                            <p class="features__item-text m-0">خامات عالية الجودة ومرونه فى طلبات الاستبدال والاسترجاع</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="features__item d-flex align-items-center gap-2">
                        <div class="features__img">
                            <img class="w-100" src="assets/images/feature-3.png" alt="">
                        </div>
                        <div>
                            <h6 class="features__item-title m-0">دعم فني</h6>
                            <p class="features__item-text m-0">دعم فني على مدار اليوم للإجابة على اي استفسار لديك</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="features__item d-flex align-items-center gap-2">
                        <div class="features__img">
                            <img class="w-100" src="assets/images/feature-4.png" alt="">
                        </div>
                        <div>
                            <h6 class="features__item-title m-0">استبدال سهل</h6>
                            <p class="features__item-text m-0">يمكنك استبدال واسترجاع المنتج في حالة عدم مطابقة المواصفات.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Features End -->
    </main>

@endsection
