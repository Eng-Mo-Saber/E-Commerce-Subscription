<?php

namespace App\Providers;

use App\Events\AcceptedOrderEvent;
use App\Events\AddOrderEvent;
use App\Events\RenewSubscriptionEvent;
use App\Events\UnAcceptedOrderEvent;
use App\Events\UserRegisterEvent;
use App\Events\UserSubscriptionEvent;
use App\Listeners\SendAcceptedOrderMailListener;
use App\Listeners\SendAddOrderMailListener;
use App\Listeners\SendRenewSubscriptionMailListener;
use App\Listeners\SendSubscriptionMailListener;
use App\Listeners\SendUnAcceptedOrderMailListener;
use App\Listeners\SendWelcomeMailListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        UserRegisterEvent::class => [
            SendWelcomeMailListener::class,
        ],
        UserSubscriptionEvent::class => [
            SendSubscriptionMailListener::class,
        ],
        RenewSubscriptionEvent::class => [
            SendRenewSubscriptionMailListener::class,
        ],
        AddOrderEvent::class => [
            SendAddOrderMailListener::class,
        ],
        AcceptedOrderEvent::class => [
            SendAcceptedOrderMailListener::class,
        ],
        UnAcceptedOrderEvent::class => [
            SendUnAcceptedOrderMailListener::class,
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
