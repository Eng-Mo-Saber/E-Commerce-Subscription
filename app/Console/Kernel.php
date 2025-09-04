<?php

namespace App\Console;

use App\Events\RenewSubscriptionEvent;
use App\Jobs\AcceptedOrderJob;
use App\Jobs\SendMailBeforeEndSubscriptionJop;
use App\Jobs\SendMailComplatedOrderJop;
use App\Jobs\SendMailEndSubscriptionJop;
use App\Jobs\SendMailRenewSubscriptionJop;
use App\Jobs\UnAcceptedOrderJob;
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
        
        //ارسال ايميل قبل انتهاء المده بيومين
        $schedule->job(new SendMailBeforeEndSubscriptionJop())->daily();
        
        //ارسال ايميل في يوم الانتهاء
        $schedule->job(new SendMailEndSubscriptionJop())->daily();
        
        //اختبار الاشتراك 
        $schedule->job(new SendMailRenewSubscriptionJop())->everySixHours();
        
        //تغيير حاله الطلب الي complated بعد يومين من الموافق عليه من الادمين
        $schedule->job(new SendMailComplatedOrderJop())->everySixHours();

        //command run the queue
        $schedule->command('queue:run')->everyMinute();
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
