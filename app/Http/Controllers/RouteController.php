<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Tightenco\Ziggy\Ziggy;

class RouteController extends Controller
{
    public function __invoke() {
        $ziggy = (new Ziggy)->filter(['!ignition.*', '!sanctum.*']);
        
        return response()->json($ziggy);
    }
}
