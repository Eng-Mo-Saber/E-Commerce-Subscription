<?php

namespace App\Console;

use App\Events\RenewSubscriptionEvent;
use App\Mail\BeforeEndSubscriptionMail;
use App\Mail\CompletedOrderMail;
use App\Mail\EndSubscriptionMail;
use App\Mail\RenewSubscriptionMail;
use App\Models\Order;
use App\Models\Payment;
use App\Models\UserSubscription;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Termwind\Components\Dd;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        //ارسال ايميل قبل انتهاء المده بيومين
        $schedule->call(function () {
            $targetDate = now()->addDays(3)->toDateString();
            $user_subscriptions = UserSubscription::whereDate('end_date', $targetDate)->get();
            foreach ($user_subscriptions as $user_subscription) {
                $user = $user_subscription->user;
                if ($user && $user->email) {
                    Mail::to($user->email)->queue(new BeforeEndSubscriptionMail($user_subscription));
                }
            }
        })->twiceDaily(0, 12);

        //ارسال ايميل في يوم الانتهاء
        $schedule->call(function () {
            $user_subscriptions = UserSubscription::whereDate('end_date', now()->toDateString())->get();
            foreach ($user_subscriptions as $user_subscription) {
                $user = $user_subscription->user;
                if ($user && $user->email) {
                    Mail::to($user->email)->queue(new EndSubscriptionMail($user_subscription));
                }
            }
        })->daily();
        
        //تغيير حاله الطلب الي complated بعد يومين من الموافق عليه من الادمين
        $schedule->call(function () {
            $orders = Order::where('status' , 'shipped')->get();
            foreach($orders as $order){
                $targetDate = $order->updated_at->addDays(2)->toDateString();
                if(now()->toDateString() == $targetDate){
                    $order->status = 'completed';
                    $order->save();
                    //mail
                    Mail::to($order->user->email)->queue(new CompletedOrderMail($order));
                }
            }
        })->everyTwoHours();

        // //اختبار الاشتراك 
        // $schedule->call(function () {
        //     //كل الاشتراكات اللي معادها انتهي
        //     // كل الاشتراكات اللي المستخدم مشترك فيها مع الاشتراك المرتبط
        //     $userSubscriptions = UserSubscription::all();

        //     // بيشوف هل مفعل تجديد تلقائي ولالا لو مفعل بيجدده لو مش مفعل بيوقفه لو انتهي
        //     foreach ($userSubscriptions as $userSubscription) {
        //         //بيشوف تاريخ النهارده هو تاريخ الانتهاء او بعد تاريخ الانتهاء 
        //         $isExpired = Carbon::now()->gt($userSubscription->end_date);
        //         if ($isExpired) {
        //             if ($userSubscription->auto_renew == 1) {
        //                 $paymentId = $userSubscription->payment_id;
        //                 $oldPayment = Payment::find($paymentId);
        //                 $newPayment = Payment::create([
        //                     'type_payment' => $oldPayment->type_payment,
        //                 ]);
        //                 $userSubsRenew = UserSubscription::create([
        //                     'user_id' => $userSubscription->id,
        //                     'subscription_id' => $userSubscription->subscription_id,
        //                     'status' => 'active',
        //                     'end_date' => now()->addDays($userSubscription->subscription->duration_in_days),
        //                     'auto_renew' => 1,
        //                     'payment_id' => $newPayment->id,
        //                 ]);
        //                 $userSubsRenewId = $userSubsRenew->id;
        //                 dd(123);
        //                 event(new RenewSubscriptionEvent($userSubsRenewId));
        //                 $userSubscription->status = 'not_active';
        //                 $userSubscription->auto_renew = 0;
        //                 $userSubscription->save();
        //             } else {
        //                 $userSubscription->status = 'not_active';
        //                 $userSubscription->save();
        //             }
        //         }
        //     }
        // })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
