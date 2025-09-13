@extends('layouts.app')

@section('title', 'نتائج البحث')

@section('content')
<div class="container py-5" style="min-height:65vh;">
    <h2 class="mb-4 fw-bold text-dark border-bottom pb-2">
        نتائج البحث عن: <span class="text-primary">"{{ $query }}"</span>
    </h2>

    @if($results->isEmpty())
        <div class="alert alert-warning text-center">
            <i class="fa-solid fa-circle-exclamation"></i> لم يتم العثور على كتب مطابقة لبحثك.
        </div>
    @else
        <div class="row">
            @foreach($results as $book)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm book-card">
                        {{-- صورة الغلاف --}}
                        <img src="{{ asset('storage/' . $book->image) }}"
                             class="card-img-top" alt="{{ $book->name }}"
                             style="height: 250px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $book->name }}</h5>
                            <p class="text-muted small mb-3" style="height: 60px; overflow:hidden;">
                                {{ Str::limit($book->description, 100, '...') }}
                            </p>
                            <p class="text-success fw-bold mb-2">
                                السعر: {{ number_format($book->price, 2) }} جنيه
                            </p>

                            {{-- زر العرض --}}
                            <a href="{{ route('single-product.page', $book->id) }}" class="btn btn-primary mt-auto">
                                <i class="fa-solid fa-book-open"></i> تفاصيل الكتاب
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection


@extends('layouts.app')

@section('title', 'نتائج البحث')

@section('content')
<div class="container py-5" style="min-height:65vh;">
    <h2 class="mb-4 fw-bold text-dark border-bottom pb-2">
        نتائج البحث عن: <span class="text-primary">"{{ $query }}"</span>
    </h2>

    @if($results->isEmpty())
        <div class="alert alert-warning text-center">
            <i class="fa-solid fa-circle-exclamation"></i> لم يتم العثور على كتب مطابقة لبحثك.
        </div>
    @else
        <div class="row">
            @foreach($results as $book)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm book-card">
                        {{-- صورة الغلاف --}}
                        <img src="{{ asset('storage/' . $book->image) }}"
                             class="card-img-top" alt="{{ $book->name }}"
                             style="height: 250px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            {{-- عنوان الكتاب --}}
                            <h5 class="card-title fw-bold text-truncate">{{ $book->name }}</h5>

                            {{-- الوصف --}}
                            <p class="text-muted small mb-3" style="height: 60px; overflow:hidden;">
                                {{ Str::limit($book->description, 100, '...') }}
                            </p>

                            {{-- زرار العرض --}}
                            <a href="{{ route('single-product.page', $book->id) }}" class="btn btn-primary mt-auto">
                                <i class="fa-solid fa-book-open"></i> عرض الكتاب
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
