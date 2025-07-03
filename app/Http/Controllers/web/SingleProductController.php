<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Payment;

use App\Models\Product;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SingleProductController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);
        $categories = Category::all();



        $userId = Auth::id();

        // كل الاشتراكات اللي المستخدم مشترك فيها مع الاشتراك المرتبط
        $userSubscriptions = UserSubscription::with('subscription')->where('user_id', $userId)->get();
        $typeSubAudio = null;
        $typeSubReading = null;
        $typeSubDownload = null;
        // بيعرف هو مشترك في انهي خدمة
        foreach ($userSubscriptions as  $userSubscription) {
            if ($userSubscription['subscription']['type'] == 'audio') {
                $typeSubAudio = $userSubscription['subscription']['type'];
            }
            if ($userSubscription['subscription']['type'] == 'reading') {
                $typeSubReading = $userSubscription['subscription']['type'];
            }
            if ($userSubscription['subscription']['type'] == 'download') {
                $typeSubDownload = $userSubscription['subscription']['type'];
            }
        }



        // هنا بيشوف هلالاشتراك انتهي ولالا 
        //لو انتهي والمستخدم مفعل التجديد التلقانئ بيعمل تجديد تلقائي
        //لو مش مفعل التجديد التلقائي بيخلي حاله الاشتراك غير مفعله
        // بيرجعلي حاله الاشتراك شغال ولا لا 

        //type audio status
        $userSubsAudioStatus = null;
        if (!$typeSubAudio == null) {
            foreach ($userSubscriptions as $userSubscription) {
                if ($userSubscription['subscription']['type'] == 'audio') {
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
                                'user_id' => $userId,
                                'subscription_id' => $userSubscription['subscription_id'],
                                'status' => 'active',
                                'end_date' => now()->addDays($userSubscription['subscription']['duration_in_days']),
                                'auto_renew' => 1,
                                'payment_id' => $newPayment['id'],
                            ]);
                            $userSubscription['status'] = 'not_active';
                            $userSubscription['auto_renew'] = 0;
                            $userSubscription->save();
                            $userSubsAudioStatus = $userSubsRenew['status'];
                        } else {
                            $userSubscription['status'] = 'not_active';
                            $userSubscription->save();
                            $userSubsAudioStatus = $userSubscription['status'];
                        }
                    } else {
                        $userSubsAudioStatus = $userSubscription['status'];
                    }
                }
            }
        }
        //type reading status
        $userSubsReadingStatus = null;
        if (!$typeSubReading == null) {
            foreach ($userSubscriptions as $userSubscription) {

                if ($userSubscription['subscription']['type'] == 'reading') {
                    $isExpired = Carbon::now()->gt($userSubscription['end_date']);
                    if ($isExpired) {
                        if ($userSubscription['auto_renew'] == 1) {
                            $userSubsRenew = UserSubscription::create([
                                'user_id' => $userId,
                                'subscription_id' => $userSubscription['subscription_id'],
                                'status' => 'active',
                                'end_date' => now()->addDays($userSubscription['subscription']['duration_in_days']),
                                'auto_renew' => 1,
                                'payment_id' => $userSubscription['payment_id'],
                            ]);
                            $userSubscription['status'] = 'not_active';
                            $userSubscription['auto_renew'] = 0;
                            $userSubscription->save();
                            $userSubsReadingStatus = $userSubsRenew['status'];
                        } else {
                            $userSubscription['status'] = 'not_active';
                            $userSubscription->save();
                            $userSubsReadingStatus = $userSubscription['status'];
                        }
                    } else {
                        $userSubsReadingStatus = $userSubscription['status'];
                    }
                }
            }
        }

        //type download status

        $userSubsDownloadStatus = null;
        if (!$typeSubDownload == null) {
            foreach ($userSubscriptions as $userSubscription) {
                if ($userSubscription['subscription']['type'] == 'download') {
                    $isExpired = Carbon::now()->gt($userSubscription['end_date']);
                    if ($isExpired) {
                        if ($userSubscription['auto_renew'] == 1) {
                            $userSubsRenew = UserSubscription::create([
                                'user_id' => $userId,
                                'subscription_id' => $userSubscription['subscription_id'],
                                'status' => 'active',
                                'end_date' => now()->addDays($userSubscription['subscription']['duration_in_days']),
                                'auto_renew' => 1,
                                'payment_id' => $userSubscription['payment_id'],
                            ]);
                            $userSubscription['status'] = 'not_active';
                            $userSubscription['auto_renew'] = 0;
                            $userSubscription->save();
                            $userSubsDownloadStatus = $userSubsRenew['status'];
                        } else {
                            $userSubscription['status'] = 'not_active';
                            $userSubscription->save();
                            $userSubsDownloadStatus = $userSubscription['status'];
                        }
                    } else {
                        $userSubsDownloadStatus = $userSubscription['status'];
                    }
                }
            }
        }


        return view(
            'single-product',
            compact(
                'categories',
                'product',
                'typeSubDownload',
                'typeSubAudio',
                'typeSubReading',
                'userSubsDownloadStatus',
                'userSubsAudioStatus',
                'userSubsReadingStatus'
            )
        );
    }
}
