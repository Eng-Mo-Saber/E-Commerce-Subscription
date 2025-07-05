<?php

namespace App\Listeners;

use App\Events\UnAcceptedOrderEvent;
use App\Mail\UnAcceptedOrderMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUnAcceptedOrderMailListener
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
     * @param  \App\Events\UnAcceptedOrderEvent  $event
     * @return void
     */
    public function handle(UnAcceptedOrderEvent $event)
    {
        Mail::to($event->user_email)->send(new UnAcceptedOrderMail($event->order));
    }
}
