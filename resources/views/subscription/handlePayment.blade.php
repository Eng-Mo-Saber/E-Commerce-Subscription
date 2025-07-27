@php
    $queryString = '';
    $secret = 'acaa262a-a929-439a-9582-b8e60c1bf30d';

    foreach ($_GET as $key => $value) {
        if ($key === 'signature' || $key === 'mode') {
            continue;
        }
        $queryString .= '&' . $key . '=' . $value;
    }

    $queryString = ltrim($queryString, '&');
    $signature = hash_hmac('sha256', $queryString, $secret, false);

    if ($signature === $_GET['signature']) {
        // تعريف المتغيرات
        $order_id = $_GET['merchantOrderId'];
        $amount = $_GET['amount'];
        $currency = $_GET['currency'];
        $status = $_GET['paymentStatus'];
        $payment_method = $_GET['cardBrand'] ?? 'card';
        $transaction_id = $_GET['transactionId'] ?? null;
        $payment_date = now();

        // إنشاء الدفع
        $payment = App\Models\Payment::create([
            'user_id' => auth()->id(),
            'subscription_id' => $subscription_id,
            'order_id' => $order_id,
            'amount' => $amount,
            'currency' => $currency,
            'status' => strtolower($status) === 'success' ? 'paid' : 'failed',
            'payment_method' => $payment_method,
            'payment_date' => $payment_date,
            'kashier_response' => json_encode($_GET), // ده اللي جاي فعليًا من الكاشير في GET
        ]);

        $subscription = App\Models\Subscription::findOrFail($subscription_id);
        $user_subscription = App\Models\UserSubscription::create([
            'user_id' => auth()->user()->id,
            'subscription_id' => $subscription_id,
            'status' => 'active',
            'end_date' => now()->addDays($subscription->duration_in_days),
            'auto_renew' => $auto_renew,
            'payment_id' => $payment->id,
        ]);
        $user_subscription_id = $user_subscription->id;
        event(new App\Events\UserSubscriptionEvent($user_subscription_id));
        return redirect()->route('payment.success', $status );
    } else {
        echo 'Failed signature';
    }
@endphp
