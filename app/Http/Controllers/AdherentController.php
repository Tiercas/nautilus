<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\DivingSession;
use App\Models\Registration;
use App\Models\Prerogative;
use App\Http\Controllers\ModificationDives;
use Illuminate\View\View;


use Illuminate\Http\Request;

class AdherentController extends Controller
{
    static function index($ds_code, $pre_code): View
    {

        $adherents = User::selectRaw('US_FIRST_NAME,US_NAME,US_LICENCE_ID, CAR_USER.US_ID, PRE_MAX_DEPTH, CAR_USER.PRE_CODE')
        ->join('CAR_PREROGATIVE','CAR_PREROGATIVE.PRE_CODE','=','CAR_USER.PRE_CODE')
        ->where('PRE_MAX_DEPTH', '>=', AdherentController::getMaxDepthByPrerogativeCode($pre_code))
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

    static function getMaxDepthByPrerogativeCode(string $pre_code)
    {
        $query = Prerogative::selectRaw('PRE_MAX_DEPTH')
        ->where('PRE_CODE', '=', $pre_code)
        ->get();

        return $query[0]['PRE_MAX_DEPTH'];

    }



    static function addUserToDive($ds_code, $us_id): View
    {

        $query = Registration::insert([
            'US_ID' => $us_id,
            'DS_CODE' => $ds_code,
            'REG_ACTIVE' => 1
        ]);

        return ModificationDives::modificationMembers($ds_code);

    }



    static function searchByName($ds_code, $pre_code, Request $request){

        $nom = $request['nom'];
        $prenom = $request['prenom'];

        $request = User::selectRaw('US_FIRST_NAME,US_NAME,US_LICENCE_ID, CAR_USER.US_ID, PRE_MAX_DEPTH')
        ->join('CAR_PREROGATIVE','CAR_PREROGATIVE.PRE_CODE','=','CAR_USER.PRE_CODE')
        ->where('PRE_MAX_DEPTH', '>=', AdherentController::getMaxDepthByPrerogativeCode($pre_code))
        ->where('US_NAME', 'LIKE', "%".$nom."%")
        ->where('US_FIRST_NAME', 'LIKE', "%".$prenom."%")
        ->get();

        $sessionplongee = DivingSession::selectRaw('CAR_DIVING_SESSION.DS_CODE, CAR_DIVING_SESSION.DS_DATE, CAR_DIVING_LOCATION.DL_NAME, CAR_DIVING_SESSION.CAR_SCHEDULE, CAR_DIVING_SESSION.DS_LEVEL')
        ->join('CAR_DIVING_LOCATION', 'CAR_DIVING_SESSION.DL_ID', '=', 'CAR_DIVING_LOCATION.DL_ID')
        ->where('ds_code', '=', $ds_code)
        ->get();

        return view('adherents', [
            'adherents' => $request,
            'sessionplongee' => $sessionplongee[0],
        ]); 

    }

}
