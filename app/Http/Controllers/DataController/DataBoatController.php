<?php

namespace App\Http\Controllers\DataController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Boat;

class DataBoatController extends Controller
{
    public static function fetch()
    {
        $boatData = Boat::all();
        return response()->json([
            'status' => 'success',
            'data' => $boatData
        ])->setStatusCode(200);
    }
}
