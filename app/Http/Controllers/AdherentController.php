<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\View\View;


use Illuminate\Http\Request;

class AdherentController extends Controller
{
    static function index($level): View
    {

        $adherents = User::selectRaw('US_FIRST_NAME,US_NAME,US_LICENCE_ID')
        ->join('car_prerogative','car_prerogative.pre_code','=','car_user.pre_code')
        ->where('car_prerogative.pre_level','>=',$level)
        ->get();

        return view('adherents', ['adherents' => $adherents]);    
    }
}
