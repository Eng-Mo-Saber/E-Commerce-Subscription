<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>رسالة بريدية</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
  <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden;">
    <tr>
      <td style="padding: 5px; background-color: #a51f1f; color: #ffffff; text-align: center;">
        <h2>تنبيه هاااام</h2>
      </td>
    </tr>
    <tr>
      <td style="padding: 35px;">
        <p>عزيزي المستخدم،{{ $user_subscription->user->name }}</p>
        <p>انتهت مدة الاشتراك {{ $user_subscription->subscription->name }} </p>
        @if($user_subscription->auto_renew)
        <p>سوف يتم تجديد الاشتراك تلقائيا ‘ وستصلك رساله تأكيد</p>
        @endif
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
