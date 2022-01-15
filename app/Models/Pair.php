<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $f_token
 * @property string $t_token
 * @property double $price
 * @property string $network
 * @property string $container_name
 * @property string $container_status
*/
class Pair extends Model
{
    protected $table = "pairs";
    public $timestamps = false;

    const BSC_MAINNET = "BSC";
    const ETH_MAINNET = "ETH";

    protected $fillable = [
        "name",
        "f_token",
        "t_token",
        "price",
        "network",
        "container_name",
        "container_status"
    ];

    public function fToken() {
        return $this->belongsTo(Token::class, "f_token", "id");
    }

    public function tToken() {
        return $this->belongsTo(Token::class, "t_token", "id");
    }
}
