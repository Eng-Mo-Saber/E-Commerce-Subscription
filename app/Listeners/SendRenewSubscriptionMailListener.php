<?php

namespace App\Listeners;

use App\Events\RenewSubscriptionEvent;
use App\Mail\RenewSubscriptionMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendRenewSubscriptionMailListener
{
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\RenewSubscriptionEvent  $event
     * @return void
     */
    public function handle(RenewSubscriptionEvent $event)
    {
        Mail::to($event->userSubsRenew->user->email)->send(new RenewSubscriptionMail($event->userSubsRenew));
    }
}
