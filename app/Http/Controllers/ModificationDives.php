<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

use App\Models\DivingSession;
use App\Models\Registration;

class ModificationDives extends Controller
{
    function index(): View {

        $request = DivingSession::selectRaw('ds_code, ds_date, car_schedule, dl_depth, dl_name')
        ->join('car_diving_location','car_diving_session.DL_ID', '=', 'car_diving_location.DL_ID')
        ->where('car_diving_session.DS_ACTIVE', '=', 1)
        ->get();

        /*
        select ds_code, dl_name, ds_date, CAR_SCHEDULE, dl_depth
        from car_diving_session
        join car_diving_location using(DL_ID)
        where car_diving_session.DS_ACTIVE = 1;*/

        return view('modification_dives', ['dives' => $request]);
    }

    static function removalOfAMemberFromASession(string $ds_code, int $us_id){
        Registration::where('car_registration.ds_code', '=', $ds_code)
        ->where('car_registration.us_id', '=', $us_id)
        ->delete();
    }

    static function modificationMembers(string $ds_code){

        $members = DivingSession::selectRaw('car_diving_session.DS_CODE, car_user.US_ID, car_user.us_name, car_user.us_first_name, car_role_attribution.ROL_CODE, car_user.US_SUB_DATE')
        ->join('car_registration', 'car_diving_session.DS_CODE', '=', 'car_registration.DS_CODE')
        ->join('car_user', 'car_registration.US_ID', '=', 'car_user.US_ID')
        ->join('car_role_attribution', 'car_user.US_ID', '=', 'car_role_attribution.US_ID')
        ->where('car_diving_session.ds_code', '=', $ds_code)
        ->get();

        /*select car_diving_session.DS_CODE, car_user.US_ID, car_user.us_name, car_user.US_FIRST_NAME, car_role_attribution.ROL_CODE
        from car_diving_session
        join car_registration on car_diving_session.DS_CODE = car_registration.DS_CODE
        join car_user on car_registration.US_ID = car_user.US_ID
        join car_role_attribution on car_user.US_ID = car_role_attribution.US_ID
        where car_diving_session.DS_CODE = 'DS2';*/

        $sessionplongee = DivingSession::selectRaw('car_diving_session.DS_CODE, car_diving_session.DS_DATE, car_diving_location.DL_NAME, car_diving_session.CAR_SCHEDULE')
        ->join('car_diving_location', 'car_diving_session.dl_id', '=', 'car_diving_location.dl_id')
        ->where('ds_code', '=', $ds_code)
        ->get();


        return view('modification_members_of_session', [
            'persons' => $members,
            'sessionplongee' => $sessionplongee,
        ]);
    }
}
