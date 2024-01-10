<?php

namespace App\Http\Controllers;

use App\Models\DivingSignUpModel;
use Illuminate\Http\Request;

class DivingSignUpController extends Controller
{
    public function show(){
        $divesList = new DivesList();
        return $divesList->index();
    }

    public function index($ds_code){
        $userid = session()->get('userid');
        session()->put('DS_CODE', $ds_code);
        $request = DivingSignUpModel::select()->where('US_ID', $userid)->where('DS_CODE', $ds_code)->count();
        if(!$request == 0)
            return redirect()->route('dives')->withErrors(['already_registered' => 'Error already registered']);
        $request = DivingSignUpModel::insert(['US_ID' => $userid, 'DS_CODE' => $ds_code, 'REG_ACTIVE' => 1]);
        return redirect()->route('dives')->with('Success', 'Inscription Success');
    }

    public static function error(){
        return view('dives')->withErrors(['userid' => 'Error with userid']);
    }
}
