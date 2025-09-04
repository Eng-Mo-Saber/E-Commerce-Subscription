<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="card shadow-lg p-4 text-center" style="max-width: 450px; width: 100%;">
    <div class="mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="green" class="bi bi-check-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm3.97-8.03a.75.75 0 0 0-1.08-1.04L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06l2.646 2.647a.75.75 0 0 0 1.06 0l4.94-4.94z"/>
        </svg>
    </div>
    <h3 class="text-success fw-bold">شكراً لك!</h3>
    <p class="text-muted">تمت عملية الدفع بنجاح. نتمنى لك تجربة رائعة معنا.</p>
    <a href="{{ route('home.page') }}" class="btn btn-success w-100 mt-3">الذهاب للصفحة الرئيسية</a>
</div>

</body>
</html>
