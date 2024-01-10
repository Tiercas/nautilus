<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DivingSession;


class DiveSessionCreation extends Controller
{
    /**
     * Add
     */
    public static function add($request)
    {
        $dv = new DivingSession();
        $dv->DS_CODE = 'DS'.sizeof(DivingSession::all())+1;
        $dv->US_ID = $request->pilot;
        $dv->DL_ID = $request->location;
        $dv->BO_ID = $request->boat;
        $dv->US_ID_CAR_SECURE = $request->security;
        $dv->US_ID_CAR_DIRECT = $request->manager;
        $dv->DS_DATE = $request->day;
        $dv->DS_MAX_DEPTH = $request->maxDepth;
        $dv->DS_ACTIVE = 1;
        $dv->DS_MAX_DIVERS = $request->max;
        $dv->DS_LEVEL = $request->level;
        $dv->save();
        return $dv;
    }
}
