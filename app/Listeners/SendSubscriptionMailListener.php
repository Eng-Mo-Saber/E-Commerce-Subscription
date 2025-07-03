<?php

namespace App\Listeners;

use App\Events\UserSubscriptionEvent;
use App\Mail\SubscriptionMail;
use App\Models\UserSubscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendSubscriptionMailListener
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
     * @param  \App\Events\UserSubscriptionEvent  $event
     * @return void
     */
    public function handle(UserSubscriptionEvent $event)
    {
        Mail::to(auth()->user()->email)->send(new SubscriptionMail($event->id));
    }
}
