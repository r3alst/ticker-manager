<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = "tokens";
    public $timestamps = false;

    protected $fillable = [
        "name",
        "symbol",
        "rate",
        "contract",
        "balance",
        "precision",
        "network"
    ];
}
