<?php

namespace App\Http\Controllers\DataController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DivingLocation;

class DataDivingLocationController extends Controller
{
    public static function fetch()
    {
        $divingLocation = DivingLocation::all();
        return response()->json([
            'status' => 'success',
            'data' => $divingLocation
        ])->setStatusCode(200);
    }
}
