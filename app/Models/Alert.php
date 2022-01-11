<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $table = "alerts";
    public $timestamps = false;
    protected $fillable = [
        "pair_id",
        "price",
        "op",
        "last_notification",
        "notified",
        "enabled"
    ];
    const OP_EQ = "eq"; // ==
    const OP_GT = "gt"; // >
    const OP_GTE = "gte"; // >=
    const OP_LT = "lt"; // <
    const OP_LTE = "lte"; // <=

    public function pair() {
        return $this->belongsTo(Pair::class, "pair_id", "id");
    }

}
