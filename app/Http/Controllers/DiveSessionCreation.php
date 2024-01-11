<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DivingSession;
use App\Models\DivingLocation;
use App\Models\Boat;
use Error;

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
        $dv->CAR_SCHEDULE = $request->hour;
        $dv->DS_MAX_DEPTH = DivingLocation::find($request->location)->DL_DEPTH;
        $dv->DS_ACTIVE = 1;
        $dv->DS_MAX_DIVERS = $request->max;
        if(intval($dv->DS_MAX_DIVERS) > Boat::find($request->boat)->BO_NUMBER_OF_SEATS)
        {
            return "Le nombre de plongeurs est supérieur au nombre de places du bateau";
        }
        $dv->PRE_CODE = $request->level;
        $dv->DS_LEVEL = 1;
        $dv->save();
        $dv->DS_CODE = 'DS'.sizeof(DivingSession::all());
        return $dv;
    }
}
