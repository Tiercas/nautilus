<?php

namespace App\Http\Controllers;

use App\Models\DivingSession;
use Illuminate\Http\Request;

class DiveSessionUpdate extends Controller
{
    //Update a diving session
    public static function update($request, $id)
    {
        $dv = DivingSession::where('DS_CODE', $id)->first();

        $dv->US_ID = $request->pilot;
        $dv->DL_ID = $request->location;
        $dv->BO_ID = $request->boat;
        $dv->US_ID_CAR_SECURE = $request->security;
        $dv->US_ID_CAR_DIRECT = $request->manager;
        $dv->DS_DATE = $request->day;
        $dv->CAR_SCHEDULE = $request->hour;
        $dv->DS_MAX_DEPTH = $request->maxDepth;
        $dv->DS_ACTIVE = 1;
        $dv->DS_MAX_DIVERS = $request->max;
        $dv->DS_LEVEL = $request->level;
        $dv->save();
    }
}

?>
