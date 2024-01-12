<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DivingSession;

class DivesApi extends Controller
{
    public static function fetch()
    {
        $dives = DivingSession::select('DS_CODE', 'DS_ACTIVE', 'CAR_DIVING_SESSION.DL_ID', 'DS_DATE', 'DL_DEPTH', 'CAR_SCHEDULE', 'DL_NAME', 'DS_MAX_DEPTH' ,'DS_DIVERS_COUNT' , 'DS_MAX_DIVERS')
        ->join('CAR_DIVING_LOCATION', 'CAR_DIVING_SESSION.DL_ID', '=', 'CAR_DIVING_LOCATION.DL_ID')
        ->where('DS_ACTIVE', 1)
        ->orderBy('DS_DATE', 'asc')
        ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Diving sessions fetched',
            'data' => $dives
        ])->setStatusCode(200);
    }
}
