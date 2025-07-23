<?php

namespace App\Jobs;

use App\Events\RenewSubscriptionEvent;
use App\Models\Payment;
use App\Models\UserSubscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMailRenewSubscriptionJop implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //كل الاشتراكات اللي معادها انتهي
        // كل الاشتراكات اللي المستخدم مشترك فيها مع الاشتراك المرتبط
        $userSubscriptions = UserSubscription::where('end_date', now()->toDateString())->get();
        // بيشوف هل مفعل تجديد تلقائي ولالا لو مفعل بيجدده لو مش مفعل بيوقفه لو انتهي
        foreach ($userSubscriptions as $userSubscription) {
            //بيشوف تاريخ النهارده هو تاريخ الانتهاء او بعد تاريخ الانتهاء
            if ($userSubscription->auto_renew == 1) {
                $paymentId = $userSubscription->payment_id;
                $oldPayment = Payment::find($paymentId);
                $newPayment = Payment::create([
                    'type_payment' => $oldPayment->type_payment,
                ]);

                $userSubsRenew = UserSubscription::create([
                    'user_id' => $userSubscription->user_id,
                    'subscription_id' => $userSubscription->subscription_id,
                    'status' => 'active',
                    'end_date' => now()->addDays($userSubscription->subscription->duration_in_days),
                    'auto_renew' => 1,
                    'payment_id' => $newPayment->id,
                ]);
                $userSubsRenewId = $userSubsRenew->id;
                event(new RenewSubscriptionEvent($userSubsRenewId));
                $userSubscription->status = 'not_active';
                $userSubscription->auto_renew = 0;
                $userSubscription->save();
            } else {
                $userSubscription->status = 'not_active';
                $userSubscription->save();
            }
        }
    }
}
