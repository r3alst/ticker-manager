<?php

use App\Http\Controllers\AlertsController;
use App\Http\Controllers\TickerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post("v1/ticker", [TickerController::class, "index"]);

Route::group([
    "prefix" => "v1/alerts"
], function() {
    Route::post("/", [AlertsController::class, "create"]);
    Route::delete("/", [AlertsController::class, "delete"]);
    Route::post("/change-status", [AlertsController::class, "changeStatus"]);
    Route::get("/", [AlertsController::class, "index"]);
});
