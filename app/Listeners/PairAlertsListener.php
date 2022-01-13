<?php

namespace App\Listeners;

use App\Events\NotifyAlert;
use App\Events\PairUpdated;
use App\Models\Alert;
use App\Models\Pair;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PairAlertsListener
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
     * @param  PairUpdated $event
     * @return void
     */
    public function handle($event)
    {
        DB::transaction(function() use($event) {
            $pair = $event->getPair();
            $alerts = Alert::query()->where([
                "pair_id" => $pair->id,
                "enabled" => 1,
                "notified" => 0
            ])->get();
            /** @var Alert $alert */
            foreach ($alerts as $alert) {
                if($alert->op === Alert::OP_EQ && $alert->price == $pair->price) {
                    $this->_updateAlert($alert);
                }
                if($alert->op === Alert::OP_GT && $pair->price > $alert->price) {
                    $this->_updateAlert($alert);
                }
                if($alert->op === Alert::OP_GTE && $pair->price >= $alert->price) {
                    $this->_updateAlert($alert);
                }
                if($alert->op === Alert::OP_LT && $pair->price < $alert->price) {
                    $this->_updateAlert($alert);
                }
                if($alert->op === Alert::OP_LTE && $pair->price <= $alert->price) {
                    $this->_updateAlert($alert);
                }
            }
        });
    }

    private function _updateAlert($alert) {
        event(new NotifyAlert($alert->id));
        $alert->notified = 1;
        $alert->last_notification = Carbon::now();
        $alert->save();
    }
}
