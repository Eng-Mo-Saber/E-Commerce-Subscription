<?php

namespace App\Listeners;

use App\Events\AddOrderEvent;
use App\Mail\AddOrderMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendAddOrderMailListener
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
     * @param  \App\Events\AddOrderEvent  $event
     * @return void
     */
    public function handle(AddOrderEvent $event)
    {
        Mail::to(auth()->user()->email)->send(new AddOrderMail($event->order_id));
    }
}
