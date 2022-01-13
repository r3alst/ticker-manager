<?php

namespace App\Providers;

use App\Events\NotifyAlert;
use App\Events\PairUpdated;
use App\Listeners\PairAlertsListener;
use App\Listeners\XDroidMessageListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NotifyAlert::class => [
            XDroidMessageListener::class
        ],
        PairUpdated::class => [
            PairAlertsListener::class
        ]
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
}
