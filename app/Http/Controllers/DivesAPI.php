<?php

namespace App\Http\Controllers;

use App\Models\DivingSession;
use App\Models\User;

class DivesAPI extends Controller
{
    function getDivers($diveID): array
    {
        $participants = User::select('*')
            ->join('CAR_REGISTRATION', 'CAR_REGISTRATION.US_ID', '=', 'CAR_USER.US_ID')
            ->join('CAR_DIVING_SESSION', 'CAR_DIVING_SESSION.DS_CODE', '=', 'CAR_REGISTRATION.DS_CODE')
            ->join('CAR_DIVING_LOCATION', 'CAR_DIVING_LOCATION.DL_ID', '=', 'CAR_DIVING_SESSION.DL_ID')
            ->where('CAR_REGISTRATION.DS_CODE', $diveID);
        $participants = $participants->get()->toArray();
        return $participants;
    }
}
