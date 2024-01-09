<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;


class DiversBySession extends Controller
{
    public function getDiversBySession($ds_code): View
    {
        $request = User::selectRaw('US_NAME, US_FIRST_NAME')
        ->join('CAR_REGISTRATION','CAR_USER.US_ID','=','CAR_REGISTRATION.US_ID')
        ->get();

        return view('diversinsessions', ['datas' => $request]);
    }

    public function getAllSessions(): View
    {
        $request = User::join('car_registration', 'car_user.US_ID', '=', 'car_registration.US_ID')
        ->groupBy('car_registration.ds_code', 'car_user.us_name', 'car_user.US_FIRST_NAME')
        ->select('car_user.us_name', 'car_user.US_FIRST_NAME', 'car_registration.ds_code')
        ->get();
    

        return view('diversinsessions',['sessions' => $request]);
    }
}
