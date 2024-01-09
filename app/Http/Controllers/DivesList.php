<?php

namespace App\Http\Controllers;

use App\Models\DivingSession;
use Illuminate\View\View;

class DivesList extends Controller
{
    function index(): View
    {
        $dives = DivingSession::select('car_diving_session.DL_ID', 'DS_DATE', 'DL_DEPTH', 'CAR_SCHEDULE', 'DL_NAME')
            ->join('car_diving_location', 'car_diving_session.DL_ID', '=', 'car_diving_location.DL_ID')
            ->get();
        return view('dives', ['dives' => $dives]);
    }
}
