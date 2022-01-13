<?php
namespace App\Events;

use App\Models\Alert;
use Illuminate\Foundation\Events\Dispatchable;

class NotifyAlert
{
    use Dispatchable;

    protected $alertId;

    /**
     * Create a new event instance.
     *
     * @param $alertId
     */
    public function __construct($alertId)
    {

        $this->alertId = $alertId;
    }

    /**
     * @return Alert
     */
    public function getAlert() {
        return Alert::query()->find($this->alertId);
    }
}
