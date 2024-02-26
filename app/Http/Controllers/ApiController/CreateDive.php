<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DivingSession;
use App\Models\User;
use App\Models\DivingLocation;
use App\Models\Boat;
use App\Models\Prerogative;

class CreateDive extends Controller
{
    public static function create(Request $request){
      if($request->DS_DATE == null || $request->DS_START_TIME == null 
      || $request->LOCATION == null || $request->DS_MIN_DIVER == null 
      || $request->DS_MAX_DIVER == null || $request->BOAT == null 
      || $request->DS_LEVEL == null || $request->DS_SECURITY == null
      || $request->DS_PILOT == null || $request->DS_DIRECTOR == null)
        return CreateDive::error('Missing required fields');
        $date = explode('/', $request->DS_DATE);
        if(count($date) != 3 || !checkdate($date[1], $date[0], $date[2]))
          return CreateDive::error('DS_DATE must be a valid date (dd/mm/yyyy)');
        if(strcasecmp($request->DS_START_TIME, 'soir') !== 0
          && strcasecmp($request->DS_START_TIME, 'matin') !== 0
          && strcasecmp($request->DS_START_TIME, 'apres-midi') !== 0)
          return CreateDive::error('DS_START_TIME must be "soir", "matin" or "apres-midi"');
        if($request->DS_MIN_DIVER < 0 || $request->DS_MAX_DIVER < 0)
          return CreateDive::error('DS_MIN_DIVER and DS_MAX_DIVER must be positive');
        if($request->DS_MIN_DIVER > $request->DS_MAX_DIVER)
          return CreateDive::error('DS_MIN_DIVER must be less than DS_MAX_DIVER');
        $US_ID = $request->DS_PILOT;
        $US_ID_CAR_SECURE = $request->DS_SECURITY;
        $US_ID_CAR_DIRECT = $request->DS_DIRECTOR;
        if(!User::find($US_ID))
          return CreateDive::error('DS_PILOT must be a valid user');
        if(!User::find($US_ID_CAR_SECURE))
          return CreateDive::error('DS_DIRECTOR must be a valid user');
        if(!User::find($US_ID_CAR_DIRECT))
          return CreateDive::error('DS_SECURITY must be a valid user');

        $dive = new DivingSession;
        $divingSessionCount = DivingSession::count();
        $dive->DS_CODE = 'DS' . ($divingSessionCount + 1);
        $dive->US_ID = $request->DS_PILOT;
        $dive->DL_ID = $request->LOCATION;
        $dive->BO_ID = $request->BOAT;
        $dive->US_ID_CAR_SECURE = $request->DS_SECURITY;
        $dive->US_ID_CAR_DIRECT = $request->DS_DIRECTOR;
        $dive->DS_DATE = $request->DS_DATE;
        $dive->CAR_SCHEDULE = $request->DS_START_TIME;
        $dive->DS_MAX_DEPTH = DivingLocation::find($request->LOCATION)->DL_DEPTH;
        $dive->DS_ACTIVE = 1;
        $dive->DS_MAX_DIVERS = $request->DS_MAX_DIVER;
        $dive->DS_MIN_DIVERS = $request->DS_MIN_DIVER;

        if(intval($request->DS_MAX_DIVER) > Boat::find($request->BOAT)->BO_NUMBER_OF_SEATS)
          return CreateDive::error('DS_MAX_DIVER must be less than or equal to the maximum number of divers of the boat');
        $dive->PRE_CODE = $request->DS_LEVEL;
        $dive->DS_LEVEL = Prerogative::find($request->DS_LEVEL)->PRE_LEVEL;
        $dive->save();
        $dive->DS_CODE = 'DS' .sizeof(DivingSession::all());
        return response()->json([
            'status' => 'success',
            'message' => 'Dive created',
            'data' => $dive
        ])->setStatusCode(200);
    }
    public static function error($message){
      return response()->json([
          'status' => 'error',
          'message' => $message
      ])->setStatusCode(400);
    }
}
