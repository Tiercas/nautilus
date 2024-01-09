<?php

namespace App\Http\Controllers;

use App\Models\DivingSignUpModel;
use Illuminate\Http\Request;

class DivingSignUpController extends Controller
{
    public function show($userid){
        if(!preg_match('/[0-9]+/', $userid))
            //TODO ERROR
            return;
        return view('diving-sign-up', ['userid' => $userid]);
    }

    public function index($userid, $ds_code){
        $request = DivingSignUpModel::select()->where('US_ID', $userid)->where('DS_CODE', $ds_code)->count();
        if(!$request == 0)
        //TODO ERROR
            return;
        $request = DivingSignUpModel::insert(['US_ID' => $userid, 'DS_CODE' => $ds_code]);
        redirect('/signup/{{$userid}}');
    }
}
