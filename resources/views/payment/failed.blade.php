<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="card shadow-lg p-4 text-center" style="max-width: 450px; width: 100%;">
    <div class="mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="red" class="bi bi-x-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zM4.646 4.646a.5.5 0 0 0 0 .708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646a.5.5 0 0 0-.708 0z"/>
        </svg>
    </div>
    <h3 class="text-danger fw-bold">عذراً!</h3>
    <p class="text-muted">فشلت عملية الدفع. حاول مرة أخرى .</p>
    <a href="{{ route('home.page') }}" class="btn btn-danger w-100 mt-3">العودة للصفحة الرئيسية</a>
</div>

</body>
</html>
