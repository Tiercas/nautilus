<?php

namespace App\Http\Controllers;

use App\Models\DivingNumberModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DivingNumberController extends Controller
{
    public function index(): View{
        $request = DivingNumberModel::select()->join('car_registration', 'car_user.us_id', '=', 'car_registration.us_id')
        ->join('car_diving_group', function($dg){
            $dg->on('car_registration.ds_code', '=', 'car_diving_group.ds_code')
            ->on('car_registration.dg_number', '=', 'car_diving_group.dg_number');
        })->count();
        return view('alldiversactivities', ['users'=>$users]);
    }
}
