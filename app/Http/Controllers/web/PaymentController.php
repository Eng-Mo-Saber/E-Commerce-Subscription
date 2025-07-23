<?php

namespace App\Http\Controllers\web;

use App\Events\UserSubscriptionEvent;
use App\Http\Controllers\Controller;
use App\Mail\SendSubscriptionMail;
use App\Mail\SubscriptionMail;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PaymentController extends Controller
{

    public function index($id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('subscription.payment', compact('subscription'));
    }

    function redirectToKashier(Request $request)
    {
        session(['auto_renew' => $request->auto_renew, 'subscription_id' => $request->subscription_id]);

        $subscription = Subscription::findOrFail($request->subscription_id);
        $user = auth()->user();

        $merchantId = "MID-36901-346"; // Merchant ID من كاشير
        $secret = "acaa262a-a929-439a-9582-b8e60c1bf30d"; // Secret Key من كاشير
        $orderId = 'sub-' . now()->timestamp . '-' . $subscription->id; // رقم طلب فريد
        $amount = $subscription->price; // لازم *100
        $currency = "EGP";
        $mode = "test"; // أو "live" حسب الحالة

        $successRedirect = route('payment.handle');
        // === بناء الـ path للتوقيع ===
        $path = "/?payment={$merchantId}.{$orderId}.{$amount}.{$currency}";
        $hash = hash_hmac('sha256', $path, $secret, false);

        // === بناء رابط الدفع ===
        $paymentURL = "https://payments.kashier.io/?" .
            "merchantId={$merchantId}" .
            "&orderId={$orderId}" .
            "&amount={$amount}" .
            "&currency={$currency}" .
            "&hash={$hash}" .
            "&mode={$mode}" .
            "&merchantRedirect={$successRedirect}" .
            "&failureRedirect={$successRedirect}" .
            "&customer[name]=" . urlencode($user->name) .
            "&customer[email]=" . urlencode($user->email) .
            "&interactionSource=Ecommerce" .
            "&enable3DS=true";

        return redirect()->away($paymentURL);
    }
    public function handlePayment()
    {
        if ($_GET['paymentStatus'] == 'SUCCESS') {
            $auto_renew = session('auto_renew');
            $subscription_id = session('subscription_id');

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
                $payment = Payment::create([
                    'user_id' => auth()->id(),
                    'subscription_id' => $subscription_id,
                    'order_id' => $order_id,
                    'amount' => $amount,
                    'currency' => $currency,
                    'status' => strtolower($status),
                    'payment_method' => $payment_method,
                    'payment_date' => $payment_date,
                    'kashier_response' => json_encode($_GET), // ده اللي جاي فعليًا من الكاشير في GET
                ]);

                $subscription = Subscription::findOrFail($subscription_id);
                $user_subscription = UserSubscription::create([
                    'user_id' => auth()->user()->id,
                    'subscription_id' => $subscription_id,
                    'status' => 'active',
                    'end_date' => now()->addDays($subscription->duration_in_days),
                    'auto_renew' => $auto_renew,
                    'payment_id' => $payment->id,
                ]);
                $user_subscription_id = $user_subscription->id;
                event(new UserSubscriptionEvent($user_subscription_id));
                return redirect()->route('home.page')->with('success', 'Payment Success');
            } else {
                return redirect()->route('home.page')->with('error', 'Payment UnSuccess');
            }
        }else{

            return redirect()->route('home.page')->with('error', 'Payment UnSuccess');
        }
    }

    public function show($id)
    {
        $userSubscription = UserSubscription::find($id);
        $payment = Payment::find($userSubscription->payment_id);
        return view('subscription.paymentInvoice', compact('userSubscription',  'payment'));
    }
}
