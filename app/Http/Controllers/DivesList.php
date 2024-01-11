<?php

namespace App\Http\Controllers;

use App\Models\DivingSession;
use Illuminate\View\View;

class DivesList extends Controller
{
    function index(): View
    {
        $dives = DivingSession::select('DS_CODE', 'CAR_DIVING_SESSION.DL_ID', 'DS_DATE', 'DL_DEPTH', 'CAR_SCHEDULE', 'DL_NAME')
            ->join('CAR_DIVING_LOCATION', 'CAR_DIVING_SESSION.DL_ID', '=', 'CAR_DIVING_LOCATION.DL_ID')
            ->get();
        return view('dives', ['dives' => $dives]);
    }
}
