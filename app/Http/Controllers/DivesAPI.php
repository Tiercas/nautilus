<?php

namespace App\Http\Controllers;

use App\Models\DivingSession;

class DivesAPI extends Controller
{
    function getDivers($diveID): array
    {
        return DivingSession::find($diveID)->getParticipants();
    }
}
