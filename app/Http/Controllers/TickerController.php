<?php

namespace App\Http\Controllers;

use App\Events\PairUpdated;
use App\Models\Pair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TickerController extends Controller
{
    public function index(Request $request) {
        $data = array_merge([
            "rate" => 0,
            "pair" => "",
            "network" => "BSC"
        ], $request->all());
        $data["rate"] = floatval($data["rate"]);
        if($data["rate"] > 0) {
            DB::transaction(function() use($data) {
                $pair = Pair::query()->where([
                    "network" => $data["network"],
                    "pair" => $data["pair"]
                ])->first();
                if(!$pair) return; // If Pair don't exist...
                $pair->price = $data["rate"];
                if($pair->save()) {
                    event(new PairUpdated($pair));
                }
            });
        }
        Log::info("TICKER", $request->all());
        return [];
    }
}
