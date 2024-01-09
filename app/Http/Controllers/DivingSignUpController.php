<?php

namespace App\Http\Controllers;

use App\Models\DivingSignUpModel;
use Illuminate\Http\Request;

class DivingSignUpController extends Controller
{
    public function show(){
        $userid = session()->get('userid');
        if(!preg_match('/[0-9]+/', $userid))
            return DivingSignUpController::error();
        return view('diving-sign-up');
    }

    public function index($ds_code){
        $userid = session()->get('userid');
        $request = DivingSignUpModel::select()->where('US_ID', $userid)->where('DS_CODE', $ds_code)->count();
        if(!$request == 0)
            return redirect()->route('signup')->withErrors(['already_registered' => 'Error already registered']);
        $request = DivingSignUpModel::insert(['US_ID' => $userid, 'DS_CODE' => $ds_code]);
        return redirect()->route('signup')->with('Success', 'inscription success');
    }

    public static function error(){
        return view('diving-sign-up')->withErrors(['userid' => 'Error with userid']);
    }
}