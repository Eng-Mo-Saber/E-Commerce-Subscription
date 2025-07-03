<?php

namespace App\Listeners;

use App\Events\AcceptedOrderEvent;
use App\Mail\AcceptedOrderMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendAcceptedOrderMailListener
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
     * @param  \App\Events\AcceptedOrderEvent  $event
     * @return void
     */
    public function handle(AcceptedOrderEvent $event)
    {
        Mail::to(auth()->user()->email)->send(new AcceptedOrderMail($event->order_id));
    }
}
