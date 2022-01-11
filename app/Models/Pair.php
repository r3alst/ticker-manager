<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pair extends Model
{
    protected $table = "pairs";
    public $timestamps = false;

    const BSC_MAINNET = "BSC";

    protected $fillable = [
        "name",
        "f_token",
        "t_token",
        "price",
        "network",
        "container_name",
        "container_status"
    ];
}
