<?php
namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Pair;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AlertsController extends Controller
{
    public function create(Request $request) {
        $data = array_merge([
            "pair_name" => "",
            "network" => "BSC",
            "price" => 0,
            "op" => "eq",
            "enabled" => 0
        ], $request->all());

        /** @var Pair $pair */
        $pair = Pair::query()->where([
            "name" => $data["pair_name"],
            "network" => $data["network"]
        ])->first();

        $alert = new Alert();
        $alert->fill(Arr::only($data, [
            "price",
            "op",
            "enabled"
        ]));
        $alert->pair_id = $pair->id;
        $alert->save();
    }

    public function delete(Request $request) {
        $data = array_merge([
            "pair" => null
        ], $request->only(["id"]));
        Alert::query()->where("id", $data["id"])->delete();
    }

    public function index() {
        return Alert::with(["pair", "pair.fToken", "pair.tToken"])->get();
    }

    public function changeStatus(Request $request) {
        $data = array_merge([
            "id" => null,
            "status" => 0
        ], $request->only(["status"]));
        /** @var Alert $alert */
        $alert = Alert::query()->where("id", $data["id"])->first();
        $alert->enabled = !!$data["status"] ? 1 : 0;
        $alert->save();
    }
}
