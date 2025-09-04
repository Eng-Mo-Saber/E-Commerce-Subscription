<?php

namespace App\Http\Controllers\Api\Web\Payment;

use App\Events\UserSubscriptionEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriptionResource;
use App\Http\Resources\UserSubscriptionResource;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\UserSubscription;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class PaymentSubscriptionController extends Controller
{
    use ApiResponseTrait ;
    public function index($id)
    {
        $subscription = Subscription::findOrFail($id);
        return $this->response_success(['subscription' => new SubscriptionResource($subscription)]);
    }

    function redirectToKashier(Request $request)
    {

        $subscription = Subscription::findOrFail($request->subscription_id);
        $user = auth()->user();

        $merchantId = "MID-36901-346"; // Merchant ID من كاشير
        $secret = "acaa262a-a929-439a-9582-b8e60c1bf30d"; // Secret Key من كاشير
        $orderId = 'sub-' . now()->timestamp . '-' . $subscription->id; // رقم طلب فريد
        $amount = $subscription->price; // 
        $currency = "EGP";
        $mode = "test"; // أو "live" حسب الحالة
        $user_sub_renew = $user->id . '_' . $request->subscription_id . '_' . $request->auto_renew;
        $successRedirect = url('/api/payment/handle'
            . '?user_sub_renew=' . $user_sub_renew);
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

        return $this->response_success(['url_Payment' => $paymentURL, 'subscription_id' => $request->subscription_id, 'auto_renew' => $request->auto_renew]);
    }
    public function handlePayment(Request $request)
    {

        $user_sub_renew = $request->query('user_sub_renew');
        $parts = explode("_", $user_sub_renew);
        $user_id = $parts[0];
        $subscription_id = $parts[1];
        $auto_renew = $parts[2];
        $paymentStatus = $request->query('paymentStatus');
        $signatureUrl = $request->query('signature');
        if ($paymentStatus == 'SUCCESS') {
            $queryString = '';
            $secret = 'acaa262a-a929-439a-9582-b8e60c1bf30d';

            foreach ($request->query() as $key => $value) {
                if ($key === 'signature' || $key === 'mode' || $key === 'user_sub_renew') {
                    continue;
                }
                $queryString .= '&' . $key . '=' . $value;
            }

            $queryString = ltrim($queryString, '&');
            $signature = hash_hmac('sha256', $queryString, $secret, false);
            if ($signature === $signatureUrl) {
                // تعريف المتغيرات
                $order_id = $request->query('merchantOrderId');
                $amount = $request->query('amount');
                $currency = $request->query('currency');
                $status = $paymentStatus;
                $payment_method = $request->query('cardBrand') ?? 'card';
                $transaction_id = $request->query('transactionId') ?? null;
                $payment_date = now();

                // إنشاء الدفع
                $payment = Payment::create([
                    'user_id' => $user_id,
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
                    'user_id' => $user_id,
                    'subscription_id' => $subscription_id,
                    'status' => 'active',
                    'end_date' => now()->addDays($subscription->duration_in_days),
                    'auto_renew' => $auto_renew,
                    'payment_id' => $payment->id,
                ]);
                $user_subscription_id = $user_subscription->id;
                event(new UserSubscriptionEvent($user_subscription_id));
                return $this->response_success(null , 'Payment Success');
            } else {
                return $this->response_error('Payment UnSuccess');
            }
        } else {
            return $this->response_error('Payment UnSuccess');
        }
    }
    
    public function show($id)
    {
        $userSubscription = UserSubscription::findOrFail($id);
        return $this->response_success(['userSubscription' => new UserSubscriptionResource($userSubscription )]);
    }
}
