<?php

namespace App\Http\Controllers;

use App\Models\DivingSession;
use Illuminate\View\View;

class DivesByDiverList extends Controller
{
    public function index($diver_name, $diver_firstname): View
    {
        $divesByDiver = DivingSession::select('DS_CODE', 'car_diving_session.DL_ID', 'DS_DATE', 'DL_DEPTH', 'CAR_SCHEDULE', 'DL_NAME')
            ->join('car_diving_location', 'car_diving_session.DL_ID', '=', 'car_diving_location.DL_ID')
            ->join('car_registration', 'car_diving_session.DS_CODE', '=', 'car_registration.DS_CODE')
            ->join('car_user', 'car_diving_session.US_ID', '=', 'car_user.US_ID')
            ->where('US_NAME', $diver_name)
            ->where('US_FIRST_NAME', $diver_firstname)
            ->get();
        return view('divesByDiver', ['divesByDiver' => $divesByDiver]);
    }
}