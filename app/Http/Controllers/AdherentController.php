<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\DivingSession;
use App\Models\Registration;
use App\Http\Controllers\ModificationDives;
use Illuminate\View\View;


use Illuminate\Http\Request;

class AdherentController extends Controller
{
    static function index($ds_code, $level): View
    {

        $adherents = User::selectRaw('US_FIRST_NAME,US_NAME,US_LICENCE_ID, CAR_USER.US_ID')
        ->join('CAR_PREROGATIVE','CAR_PREROGATIVE.PRE_CODE','=','CAR_USER.PRE_CODE')
        ->where('CAR_PREROGATIVE.PRE_LEVEl','>=',$level)
        ->get();

        $sessionplongee = DivingSession::selectRaw('CAR_DIVING_SESSION.DS_CODE, CAR_DIVING_SESSION.DS_DATE, CAR_DIVING_LOCATION.DL_NAME, CAR_DIVING_SESSION.CAR_SCHEDULE, CAR_DIVING_SESSION.DS_LEVEL')
        ->join('CAR_DIVING_LOCATION', 'CAR_DIVING_SESSION.DL_ID', '=', 'CAR_DIVING_LOCATION.DL_ID')
        ->where('ds_code', '=', $ds_code)
        ->get();


        return view('adherents', [
            'adherents' => $adherents,
            'sessionplongee' => $sessionplongee[0],
            ]);    
    }





    static function addUserToDive($ds_code, $us_id): View
    {

        $query = Registration::insert([
            'US_ID' => $us_id,
            'DS_CODE' => $ds_code,
            'REG_ACTIVE' => 1
        ]);

        return  ModificationDives::modificationMembers($ds_code);

    }

}
