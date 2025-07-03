<?php

namespace App\Console;

use App\Mail\BeforeEndSubscriptionMail;
use App\Mail\EndSubscriptionMail;
use App\Models\UserSubscription;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
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
        $schedule->call(function(){
            $targetDate = now()->addDays(3)->toDateString() ;
            $user_subscriptions = UserSubscription::whereDate('end_date' , $targetDate )->get();
            foreach($user_subscriptions as $user_subscription){
                $user = $user_subscription->user;
                if($user && $user->email){
                    Mail::to($user->email)->send(new BeforeEndSubscriptionMail($user_subscription));
                }
            }
        })->twiceDaily(0 , 12);
        
        //ارسا ايميل في يوم الانتهاء
        $schedule->call(function(){
            $user_subscriptions = UserSubscription::whereDate('end_date' , now()->toDateString() )->get();
            foreach($user_subscriptions as $user_subscription){
                $user = $user_subscription->user;
                if($user && $user->email){
                    Mail::to($user->email)->send(new EndSubscriptionMail($user_subscription));
                }
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
