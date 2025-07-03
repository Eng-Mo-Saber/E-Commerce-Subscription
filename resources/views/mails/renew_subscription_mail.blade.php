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
        <h2>الإشتراك في الخدمة</h2>
      </td>
    </tr>
    <tr>
      <td style="padding: 35px;">
        <p>عزيزي المستخدم،{{ $userSubsRenew->user->name }}</p>
        <p>{{ $userSubsRenew->subscription->name }}  تم تجديد الاشتراك في  خدمة  </p>
        <p>EGP {{ $userSubsRenew->subscription->price }}  سعر الخدمة  </p>
        <p>{{ $userSubsRenew->end_date }}  تاريخ انتهاء </p>
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
