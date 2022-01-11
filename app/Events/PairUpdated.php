<?php
namespace App\Events;

use App\Models\Pair;
use Illuminate\Foundation\Events\Dispatchable;

class PairUpdated
{
    use Dispatchable;

    /**
     * @var integer
     */
    protected $pairId;

    /**
     * Create a new event instance.
     *
     * @param $pairId
     */
    public function __construct($pairId)
    {
        $this->pairId = $pairId;
    }

    public function getPair() {
        return Pair::query()->find($this->pairId);
    }
}
