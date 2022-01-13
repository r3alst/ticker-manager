<?php

namespace App\Listeners;

use App\Events\NotifyAlert;
use App\Models\Pair;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class XDroidMessageListener
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
     * @param  NotifyAlert $event
     * @return void
     */
    public function handle($event)
    {
        $alert = $event->getAlert();
        /** @var Pair $pair */
        $pair = $alert->pair()->first();
        $guzzleClient = new Client();
        try {
            $guzzleClient->get("http://xdroid.net/api/message?k=".urlencode(env("XDROID_API_KEY", ""))."&t=".urlencode($pair->name . " (" . $alert->op . ") " . $alert->price)."&c=".urlencode("Price: {$pair->price}"));
        } catch (GuzzleException $e) {
            Log::error($e->getMessage(), $e->getTrace());
        }
    }
}
