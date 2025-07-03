@extends('layouts.app')

@section('title', 'تفاصيل الاشتراك والدفع')

@section('content')
    <div class="container py-5" style="margin-top: 100px;">
        <div class="row">
            {{-- ✅ تفاصيل الاشتراك --}}
            <div class="col-md-5">
                <div class="card shadow-sm p-4">
                    <h3 class="text-primary fw-bold mb-3">{{ $subscription->name }}</h3>
                    <p><strong>النوع:</strong> {{ $subscription->type }}</p>
                    <p><strong>الوصف:</strong> {{ $subscription->description }}</p>
                    <p><strong>السعر:</strong> {{ $subscription->price }} جنيه</p>
                    <p><strong>عدد الأيام:</strong> {{ $subscription->duration_in_days }} يوم</p>
                </div>
            </div>

            {{--  فورم الدفع --}}
            <div class="col-md-7">
                <div class="card shadow-sm p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('payment.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">

                        {{-- تجديد تلقائي --}}
                        <div class="mb-3">
                            <label class="form-label">تجديد تلقائي؟</label>
                            <select class="form-select" name="auto_renew" required>
                                <option value="1">نعم</option>
                                <option value="0">لا</option>
                            </select>
                        </div>

                        {{-- طريقة الدفع --}}
                        <div class="mb-3">
                            <label class="form-label">طريقة الدفع</label>
                            <select class="form-select" name="type_payment" id="paymentMethod" required
                                onchange="togglePaymentFields(this.value)">
                                <option value="">اختر طريقة الدفع</option>
                                <option value="cash">Cash</option>
                                <option value="credit">Credit Card </option>
                            </select>
                        </div>

                        {{-- كاش --}}
                        <div class="mb-3 d-none" id="cashField">
                            <label class="form-label">Cash Number</label>
                            <input type="text" name="cash_number" class="form-control" placeholder="مثلاً: 010xxxxxxx">
                        </div>

                        {{-- كريديت كارد --}}
                        <div id="creditFields" class="d-none">
                            <div class="mb-3">
                                <label class="form-label">Card Number</label>
                                <input type="text" name="card_number" class="form-control"
                                    placeholder="1234 5678 9012 3456">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">تاريخ الانتهاء</label>
                                <input type="month" name="card_end_date" class="form-control" placeholder="MM/YY">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">رمز الأمان (CVV)</label>
                                <input type="text" name="card_CVV" class="form-control" placeholder="مثلاً: 123">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100">اشترك الآن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--  سكريبت لتبديل الحقول --}}
    <script>
        function togglePaymentFields(method) {
            document.getElementById('cashField').classList.add('d-none');
            document.getElementById('creditFields').classList.add('d-none');

            if (method === 'cash') {
                document.getElementById('cashField').classList.remove('d-none');
            } else if (method === 'credit') {
                document.getElementById('creditFields').classList.remove('d-none');
            }
        }
    </script>
@endsection
