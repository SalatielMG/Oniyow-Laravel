<?php

namespace oniyow\Listeners;

use Mail;
use oniyow\Events\eventMailFactura;
use oniyow\Mail\correoFactura;


class ListenerMailFactura
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
     * @param  eventMailFactura  $event
     * @return void
     */
    public function handle(eventMailFactura $event)
    {
        //dd($event -> email);
        Mail::to($event -> email) -> send(new correoFactura($event -> factura, $event -> admin));
    }
}
