<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>رسالة بريدية</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
  <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden;">
    <tr>
      <td style="padding: 5px; background-color: #198754; color: #ffffff; text-align: center;">
        <h2> تمت الموافقة علي الطلب </h2>
      </td>
    </tr>
    <tr>
      <td style="padding: 35px;">
        <p> {{ Auth::user()->name }} عزيزي المستخدم، </p>
        <p>تم الموافقة علي طلبك</p>
        <p>تم شحن طلبك</p>
        <p>تفاصيل الطلب</p>
        {{-- عرض تفاصيل الطلب --}}

        @foreach ( $order_items as $order_item )
        <p>------------------------------------------------------</p>
        <p>إسم الكتاب : {{ $order_item->product->name }}</p>
        <p>سعر الكتاب : {{ $order_item->product->price }}</p>
        <p> الكيمة المطلوبة : {{ $order_item->quantity }}</p>
        @endforeach
        <p>-------------------</p>
        <p>  رقم الطلب : {{ $order->id }}</p>
        <p>  حاله الطلب : {{ $order->status }}</p>
        <p> السعر الكلي للطلب : {{ $order->total_price }}</p>
        <p>تحياتنا، Coding Arabic <br>فريق الدعم</p>
      </td>
    </tr>
    <tr>
      <td style="padding: 10px; background-color: #f0f0f0; text-align: center; font-size: 12px; color: #888;">
        &copy; 2025 كل الحقوق محفوظة
      </td>
    </tr>
  </table>
</body>
</html>
