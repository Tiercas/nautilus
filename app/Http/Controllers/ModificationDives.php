<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

use App\Models\DivingSession;
use App\Models\Registration;
use App\Models\User;

class ModificationDives extends Controller
{

    static function sessionContainsPilot($ds_code){
        $query = DivingSession::selectRaw('US_ID')
        ->where('DS_CODE', '=', $ds_code)
        ->get();
        return($query[0]['US_ID'] != 0);
    }

    static function sessionContainsSecurity($ds_code){
        $query = DivingSession::selectRaw('US_ID_CAR_SECURE')
        ->where('DS_CODE', '=', $ds_code)
        ->get();
        return($query[0]['US_ID_CAR_SECURE'] != 0);
    }

    static function sessionContainsDirector($ds_code){
        $query = DivingSession::selectRaw('US_ID_CAR_DIRECT')
        ->where('DS_CODE', '=', $ds_code)
        ->get();
        return($query[0]['US_ID_CAR_DIRECT'] != 0);
    }

    function index(): View {

        $request = DivingSession::selectRaw('DS_CODE, DS_DATE, CAR_SCHEDULE, DL_DEPTH, DL_NAME')
        ->join('CAR_DIVING_LOCATION','CAR_DIVING_SESSION.DL_ID', '=', 'CAR_DIVING_LOCATION.DL_ID')
        ->where('CAR_DIVING_SESSION.DS_ACTIVE', '=', 1)
        ->get();

        /*
        select ds_code, dl_name, ds_date, CAR_SCHEDULE, dl_depth
        from car_diving_session
        join car_diving_location using(DL_ID)
        where car_diving_session.DS_ACTIVE = 1;*/


        return view('modification_dives', ['dives' => $request]);
    }



    static function removalOfAMemberFromASession(string $ds_code, int $us_id){
        Registration::where('CAR_REGISTRATION.DS_CODE', '=', $ds_code)
        ->where('CAR_REGISTRATION.US_ID', '=', $us_id)
        ->delete();

        return ModificationDives::modificationMembers($ds_code);
    }







    static function modificationMembers(string $ds_code){

        $pilote_temp = DivingSession::selectRaw('US_FIRST_NAME,US_NAME,US_LICENCE_ID, CAR_USER.US_ID')
        ->join('CAR_USER','CAR_DIVING_SESSION.US_ID','=','CAR_USER.US_ID')
        ->where('CAR_DIVING_SESSION.DS_CODE', '=', $ds_code)
        ->get();


        $pilote = [
            'US_FIRST_NAME' => $pilote_temp[0]['US_FIRST_NAME'],
            'US_NAME' => $pilote_temp[0]['US_NAME'],
            'US_LICENCE_ID' => $pilote_temp[0]['US_LICENCE_ID'],
            'US_ID' => $pilote_temp[0]['US_ID'],
            'ROL_LABEL' => "Pilote"
        ];

        $securite_temp = DivingSession::selectRaw('US_FIRST_NAME,US_NAME,US_LICENCE_ID, CAR_USER.US_ID')
        ->join('CAR_USER','CAR_DIVING_SESSION.US_ID_CAR_SECURE','=','CAR_USER.US_ID')
        ->where('CAR_DIVING_SESSION.DS_CODE', '=', $ds_code)
        ->get();

        $securite = [
            'US_FIRST_NAME' => $securite_temp[0]['US_FIRST_NAME'],
            'US_NAME' => $securite_temp[0]['US_NAME'],
            'US_LICENCE_ID' => $securite_temp[0]['US_LICENCE_ID'],
            'US_ID' => $securite_temp[0]['US_ID'],
            'ROL_LABEL' => "Sécurité de surface"
        ];

        $directeur_temp = DivingSession::selectRaw('US_FIRST_NAME,US_NAME,US_LICENCE_ID, CAR_USER.US_ID')
        ->join('CAR_USER','CAR_DIVING_SESSION.US_ID_CAR_DIRECT','=','CAR_USER.US_ID')
        ->where('CAR_DIVING_SESSION.DS_CODE', '=', $ds_code)
        ->get();

        $directeur = [
            'US_FIRST_NAME' => $directeur_temp[0]['US_FIRST_NAME'],
            'US_NAME' => $directeur_temp[0]['US_NAME'],
            'US_LICENCE_ID' => $directeur_temp[0]['US_LICENCE_ID'],
            'US_ID' => $directeur_temp[0]['US_ID'],
            'ROL_LABEL' => "Directeur"
        ];

        $plongeurs = User::selectRaw('US_FIRST_NAME,US_NAME,US_LICENCE_ID, ROL_LABEL, CAR_USER.US_ID')
        ->join('CAR_PREROGATIVE','CAR_PREROGATIVE.PRE_CODE','=','CAR_USER.PRE_CODE')
        ->join('CAR_ROLE_ATTRIBUTION','CAR_USER.US_ID','=','CAR_ROLE_ATTRIBUTION.US_ID')
        ->join('CAR_ROLE','CAR_ROLE_ATTRIBUTION.ROL_CODE','=','CAR_ROLE.ROL_CODE')
        ->join('CAR_REGISTRATION', 'CAR_USER.US_ID', '=', 'CAR_REGISTRATION.US_ID')
        ->join('CAR_DIVING_SESSION', 'CAR_REGISTRATION.DS_CODE', '=', 'CAR_DIVING_SESSION.DS_CODE')
        ->where('CAR_DIVING_SESSION.DS_CODE', '=', $ds_code)
        ->where('CAR_ROLE.ROL_CODE','=','DIV')
        ->get();

        $adherents = array();
        array_push($adherents, $pilote);
        array_push($adherents, $securite);
        array_push($adherents, $directeur);
        foreach($plongeurs as $plongeur){
            array_push($adherents, $plongeur);
        }

        $sessionplongee = DivingSession::selectRaw('CAR_DIVING_SESSION.DS_CODE, CAR_DIVING_SESSION.DS_DATE, CAR_DIVING_LOCATION.DL_NAME, CAR_DIVING_SESSION.CAR_SCHEDULE, CAR_DIVING_SESSION.DS_LEVEL')
        ->join('CAR_DIVING_LOCATION', 'CAR_DIVING_SESSION.DL_ID', '=', 'CAR_DIVING_LOCATION.DL_ID')
        ->where('DS_CODE', '=', $ds_code)
        ->get();


        return view('modification_members_of_session', [
            'persons' => $adherents,
            'sessionplongee' => $sessionplongee[0],
            'directeurpresent' => ModificationDives::sessionContainsDirector($ds_code),
            'pilotepresent' => ModificationDives::sessionContainsPilot($ds_code),
            'securitepresent' => ModificationDives::sessionContainsSecurity($ds_code)
        ]);    
    }
}
