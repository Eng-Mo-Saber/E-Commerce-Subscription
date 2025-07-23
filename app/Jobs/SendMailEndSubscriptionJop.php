<?php

namespace App\Jobs;

use App\Mail\EndSubscriptionMail;
use App\Models\UserSubscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailEndSubscriptionJop implements ShouldQueue
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
        $user_subscriptions = UserSubscription::whereDate('end_date', now()->toDateString())->get();
        foreach ($user_subscriptions as $user_subscription) {
            $user = $user_subscription->user;
            if ($user && $user->email) {
                Mail::to($user->email)->send(new EndSubscriptionMail($user_subscription));
            }
        }
    }
}
