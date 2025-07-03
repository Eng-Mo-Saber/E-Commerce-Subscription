<?php

namespace App\Http\Controllers\web;

use App\Events\RenewSubscriptionEvent;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Product;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        if (auth()->user()) {
            $favProductIds = auth()->user()->favorites->pluck('product_id')->toArray();

            // كل الاشتراكات اللي المستخدم مشترك فيها مع الاشتراك المرتبط
            $user = Auth::user() ;
            $userSubscriptions = UserSubscription::with('subscription')->where('user_id', $user->id)->get();

            // بيشوف هل مفعل تجديد تلقائي ولالا لو مفعل بيجدده لو مش مفعل بيوقفه لو انتهي
            foreach ($userSubscriptions as $userSubscription) {
                //بيشوف تاريخ النهارده هو تاريخ الانتهاء او بعد تاريخ الانتهاء 
                $isExpired = Carbon::now()->gt($userSubscription['end_date']);
                if ($isExpired) {
                    if ($userSubscription['auto_renew'] == 1) {
                        $paymentId = $userSubscription['payment_id'];
                        $oldPayment = Payment::find($paymentId);
                        $newPayment = Payment::create([
                            'type_payment' => $oldPayment['type_payment'],
                            'card_number' => $oldPayment['card_number'],
                            'card_end_date' => $oldPayment['card_end_date'],
                            'card_CVV' => $oldPayment['card_CVV'],
                            'cash_number' => $oldPayment['cash_number'],
                        ]);
                        $userSubsRenew = UserSubscription::create([
                            'user_id' => $user->id,
                            'subscription_id' => $userSubscription['subscription_id'],
                            'status' => 'active',
                            'end_date' => now()->addDays($userSubscription['subscription']['duration_in_days']),
                            'auto_renew' => 1,
                            'payment_id' => $newPayment['id'],
                        ]);
                        $userSubsRenewId = $userSubsRenew->id;
                        event(new RenewSubscriptionEvent($userSubsRenewId));
                        $userSubscription['status'] = 'not_active';
                        $userSubscription['auto_renew'] = 0;
                        $userSubscription->save();
                    } else {
                        $userSubscription['status'] = 'not_active';
                        $userSubscription->save();
                    }
                }
            }
            return view('home', compact('products', 'categories', 'favProductIds'));
        }
        return view('home', compact('products', 'categories'));
    }

    public function test()
    {
        return view('mails.subscription_mail');
    }
}
