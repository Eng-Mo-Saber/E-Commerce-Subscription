@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="container py-5" style="margin-top: 150px;">
        <h2 class="mb-4">عربة التسوق</h2>

        @if (count($carts) > 0)
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    @if (session('error'))
                        <div class="d-flex justify-content-center mt-3">
                            <div class="alert alert-danger w-50 text-center">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <thead class="table-dark">
                        <tr>
                            <th>الصورة</th>
                            <th>المنتج</th>
                            <th>الكمية</th>
                            <th>السعر</th>
                            <th>الإجمالي</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $cart->product->image) }}" alt="صورة المنتج"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                </td>
                                <td>{{ $cart->product->name }}</td>
                                <td>{{ $cart->quantity }}</td>
                                <td>{{ $cart->product->price }} جنيه</td>
                                <td>{{ $cart->quantity * $cart->product->price }} جنيه</td>
                                <td class="d-block d-md-table-cell text-center">
                                    <form action="{{ route('cart.destroy', $cart->id) }}" method="POST"
                                        style="display: inline;"
                                        onsubmit="return confirm('هل أنت متأكد من إزالة هذا العنصر من السلة🧺؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger fs-5 p-0 m-0"
                                            title="إزالة من السلة" style="background: none; border: none;">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-3">
                <a href="{{ route('checkout.page') }}" class="btn btn-success">اتمام الطلب</a>
            </div>
        @else
            <p>لا توجد منتجات في سلة التسوق حالياً.</p>
        @endif
    </div>
@endsection
