<?php

namespace oniyow\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'oniyow\Events\Event' => [
            'oniyow\Listeners\EventListener',
        ],
        'oniyow\Events\eventMailCompra' => [
            'oniyow\Listeners\ListenerMailCompra',
        ],
        'oniyow\Events\eventMailFactura' => [
            'oniyow\Listeners\ListenerMailFactura',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
