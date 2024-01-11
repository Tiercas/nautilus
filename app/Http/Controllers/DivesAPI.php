<?php

namespace App\Http\Controllers;

use App\Models\DivingSession;
use App\Models\User;

class DivesAPI extends Controller
{
    function getDivers($diveID): array
    {
        $participants = User::select('*')->join('CAR_REGISTRATION', 'CAR_REGISTRATION.US_ID', '=', 'CAR_USER.US_ID')->where('CAR_REGISTRATION.DS_CODE', $diveID);
        $participants = $participants->get()->toArray();
        return $participants;
    }
}
