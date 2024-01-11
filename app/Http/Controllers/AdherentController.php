<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\View\View;


use Illuminate\Http\Request;

class AdherentController extends Controller
{
    static function index($level): View
    {

        $adherents = User::selectRaw('US_FIRST_NAME,US_NAME,US_LICENCE_ID, ROL_LABEL')
        ->join('car_prerogative','car_prerogative.pre_code','=','car_user.pre_code')
        ->join('car_role_attribution','CAR_USER.US_ID','=','CAR_ROLE_ATTRIBUTION.US_ID')
        ->join('car_role','CAR_ROLE_ATTRIBUTION.ROL_CODE','=','CAR_ROLE.ROL_CODE')
        ->where('car_prerogative.pre_level','>=',$level)
        ->where('CAR_ROLE.ROL_CODE','=','DIV')
        ->get();

        return view('adherents', ['adherents' => $adherents]);    
    }
}
