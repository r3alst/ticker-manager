<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TickerController extends Controller
{
    public function index(Request $request) {
        Log::info("TICKER", $request->all());
        return [];
    }
}
