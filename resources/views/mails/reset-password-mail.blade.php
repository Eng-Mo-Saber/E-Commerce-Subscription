<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>إعادة تعيين كلمة المرور</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <table width="100%" cellpadding="0" cellspacing="0"
        style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden;">
        <tr>
            <td style="padding: 10px; background-color: #0d6efd; color: #ffffff; text-align: center;">
                <h2>إعادة تعيين كلمة المرور</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 35px;">
                <p>عزيزي </p>
                <p>لقد طلبت إعادة تعيين كلمة المرور الخاصة بك. اضغط على الزر أدناه لتعيين كلمة مرور جديدة:</p>
                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{ route('reset-password.page', ['token' => $token, 'email' => $email]) }}"
                        style="background-color: #198754; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                        إعادة تعيين كلمة المرور
                    </a>
                </div>
                <p>إذا لم تطلب إعادة التعيين، فلا داعي لاتخاذ أي إجراء.</p>

                <p>تحياتنا،<br>Coding Arabic - فريق الدعم</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px; background-color: #f0f0f0; text-align: center; font-size: 12px; color: #888;">
                &copy; 2025 جميع الحقوق محفوظة
            </td>
        </tr>
    </table>
</body>

</html>
