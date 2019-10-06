<?php

namespace oniyow\Listeners;

use Mail;
use oniyow\Events\eventMailCompra;
use oniyow\Mail\correoCompra;

class ListenerMailCompra
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
     * @param  eventMailCompra  $event
     * @return void
     */
    public function handle(eventMailCompra $event)
    {
        foreach ($event -> venta -> clienteC -> datoC -> emails as $mail){
            try{
                    Mail::to($mail -> email) -> send(new correoCompra($event -> venta));

            }catch(\Exception $e){
                $event -> error = $event -> error . "Error al enviar el mensaje al correo : $mail->email ";
            }
        }
    }
}
