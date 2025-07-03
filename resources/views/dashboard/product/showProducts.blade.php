@extends('layouts.appDashboard')

@section('title', 'Products List')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Products</h3>
            <a href="{{ route('dashboard.addProduct') }}" class="btn btn-primary float-right">Add Product</a>
        </div>

        @if (session('success'))
            <div class="d-flex justify-content-center mt-3">
                <div class="alert alert-success w-50 text-center">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap align-middle">
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Audio</th>
                        <th>PDF</th>
                        <th>Price</th>
                        <th>Author</th>
                        <th>Stock</th>
                        <th>Year</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                        <tr class="text-center">
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>

                            {{-- وصف قصير قابل للتوسيع --}}
                            <td>
                                <div style="max-height: 100px; max-width: 200px; overflow: auto; resize: vertical;" class="form-control p-1">
                                    {{ $product->description }}
                                </div>
                            </td>

                            {{-- صورة مصغرة --}}
                            <td>
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         style="width: 60px; height: 60px;"
                                         class="img-thumbnail">
                                @else
                                    <span class="text-muted">لا توجد صورة</span>
                                @endif
                            </td>

                            {{-- ملف صوتي --}}
                            <td>
                                @if ($product->audio_file)
                                    <audio controls style="width: 130px;">
                                        <source src="{{ asset('storage/' . $product->audio_file) }}" type="audio/mpeg">
                                        متصفحك لا يدعم الصوت.
                                    </audio>
                                @else
                                    <span class="text-muted">لا يوجد صوت</span>
                                @endif
                            </td>

                            {{-- ملف PDF --}}
                            <td>
                                @if ($product->book_file)
                                    <a href="{{ asset('storage/' . $product->book_file) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-info mb-1">عرض</a>
                                    <a href="{{ asset('storage/' . $product->book_file) }}"
                                       download
                                       class="btn btn-sm btn-secondary">تحميل</a>
                                @else
                                    <span class="text-muted">لا يوجد PDF</span>
                                @endif
                            </td>

                            <td>{{ $product->price }}</td>
                            <td>{{ $product->author }}</td>
                            <td>{{ $product->stock_quantity }}</td>
                            <td>{{ $product->publisher_year }}</td>
                            <td>{{ $product->category->name }}</td>

                            <td>
                                <a href="{{ route('dashboard.updateProduct', $product->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                                <form action="{{ route('deleteProduct.destroy', $product->id) }}" method="GET">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
