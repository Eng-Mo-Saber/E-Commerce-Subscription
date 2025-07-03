@extends('layouts.app')

@section('title', 'Order Details')

@section('content')

    <main>
      <div
        class="page-top d-flex justify-content-center align-items-center flex-column text-center"
      >
        <div class="page-top__overlay"></div>
        <div class="position-relative">
          <div class="page-top__title mb-3">
            <h2>تتبع طلبك</h2>
          </div>
          <div class="page-top__breadcrumb">
            <a class="text-gray" href="index.html">الرئيسية</a> /
            <span class="text-gray">تتبع طلبك</span>
          </div>
        </div>
      </div>

      <section class="section-container my-5 py-5">
        <section>
          <h2>تفاصيل الطلب</h2>
          <table class="success__table w-100 mb-5">
            <thead>
              <tr class="border-0 bg-danger text-white">
                <th>المنتج</th>
                <th class="d-none d-md-table-cell">الإجمالي</th>
              </tr>
            </thead>
            @foreach ($order_items as $item )            
            <tbody>
              <tr>
                <td>
                  <div>
                    <span class="fw-bold">اسم المنتج:</span>
                    <span>{{ $item->product->name }}</span>
                  </div>
                  <div>
                    <span class="fw-bold">سعر المنتج:</span>
                    <span>{{ $item->product->price }}</span>
                  </div>
                  <div>
                    <span class="fw-bold">الكمية:</span>
                    <span>{{ $item->quantity }}</span>
                  </div>
                </td>
                <td>{{ $item->quantity*$item->product->price }}جنيه</td>
              </tr>
            </tbody>
            @endforeach
            <tr>
              <th>إجمالي سعر الطلب:</th>
              <td class="fw-bold">{{ $order->total_price }} جنيه</td>
            </tr>
          </table>
        </section>
        <section class="mb-5">
          <h2>عنوان الفاتورة</h2>
          <div class="border p-3 rounded-3">
            <p class="mb-1">{{ $order->user->name }}</p>
            <p class="mb-1">{{ $order->address }}</p>
            <p class="mb-1">{{ $order->user->phone }}</p>
            <p class="mb-1">{{ $order->user->email }}</p>
          </div>
        </section>
      </section>
    </main>
@endsection