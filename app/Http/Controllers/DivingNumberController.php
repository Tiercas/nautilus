<?php

namespace App\Http\Controllers;
use App\Models\DivingNumberModel;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DivingNumberController extends Controller
{
    public function index(): View
    {

        if(session()->has('user')){
            $user = session('user');
            $userId = session('user')->US_ID;
        }else{
            $userId = null;
        }
        

        $dateDivesBefore = DivingNumberModel::join('car_registration', 'car_user.us_id', '=', 'car_registration.us_id')
        ->join('car_diving_session','car_registration.ds_code','=','car_diving_session.ds_code')
        ->join('car_diving_location','car_diving_session.DL_ID','=','car_diving_location.DL_ID')
        ->where('car_user.US_ID',$userId)
        ->where('CAR_DIVING_SESSION.DS_DATE','<',now())
        ->get();

        $dateDivesAfter = DivingNumberModel::join('car_registration', 'car_user.us_id', '=', 'car_registration.us_id')
        ->join('car_diving_session','car_registration.ds_code','=','car_diving_session.ds_code')
        ->join('car_diving_location','car_diving_session.dl_id','=','car_diving_location.dl_id')
        ->join('car_role_attribution','car_user.us_id','=','car_role_attribution.Us_id')
        ->join('car_role','car_role_attribution.rol_code','=','car_role.rol_code')
        ->where('CAR_DIVING_SESSION.DS_DATE','>=',now())
        ->where('car_user.US_ID',$userId)
        ->get();


        $usersCount = DivingNumberModel::join('CAR_REGISTRATION', 'CAR_USER.us_id', '=', 'CAR_REGISTRATION.us_id')
            ->join('CAR_DIVING_GROUP', function ($dg) {
                $dg->on('CAR_REGISTRATION.ds_code', '=', 'CAR_DIVING_GROUP.ds_code')
                    ->on('CAR_REGISTRATION.dg_number', '=', 'CAR_DIVING_GROUP.dg_number');
            })
            ->join('CAR_DIVING_SESSION','CAR_REGISTRATION.ds_code','=','CAR_DIVING_SESSION.ds_code')
            ->where('CAR_DIVING_SESSION.ds_date','>=',date("Y").'-00-00')
            ->where('CAR_USER.US_ID', $userId)
            ->orderBy('ds_date','desc')
            ->count();
        $usersCount = 99 - $usersCount ;

        return view('diveractivities', compact('usersCount'), ['datesB' => $dateDivesBefore,
                                                                'datesA' => $dateDivesAfter]);
    }

    public function allIndex(Request $request): View
    {

        if($request['afterthe'] != '' and $request['beforethe'] != ''){
            return DivingNumberController::afterAndBefore($request['afterthe'], $request['beforethe']);
        }
        if($request['afterthe'] != '' and $request['beforethe'] == ''){
            return DivingNumberController::after($request['afterthe']);
        }
        if($request['afterthe'] == '' and $request['beforethe'] != ''){
            return DivingNumberController::before($request['beforethe']);
        }

        $usersDatas = DivingNumberModel::selectRaw('COUNT(*) as aggregate, CAR_USER.US_FIRST_NAME, CAR_USER.US_NAME')
    ->join('CAR_REGISTRATION', 'CAR_USER.us_id', '=', 'CAR_REGISTRATION.us_id')
    ->join('CAR_DIVING_GROUP', function ($join) {
        $join->on('CAR_REGISTRATION.ds_code', '=', 'CAR_DIVING_GROUP.ds_code')
            ->on('CAR_REGISTRATION.dg_number', '=', 'CAR_DIVING_GROUP.dg_number');
    })
    ->groupBy('CAR_USER.us_id', 'CAR_USER.US_NAME', 'CAR_USER.US_FIRST_NAME')
    ->get();

        return view('alldiversactivities', ['datas' => $usersDatas]);

    }

    public function afterAndBefore(string $after, string $before): View
    {


        $usersDatas = DivingNumberModel::selectRaw('COUNT(*) as aggregate, CAR_USER.US_FIRST_NAME, CAR_USER.US_NAME')
        ->join('CAR_REGISTRATION', 'CAR_USER.us_id', '=', 'CAR_REGISTRATION.us_id')
        ->join('CAR_DIVING_SESSION', 'CAR_REGISTRATION.DS_CODE', '=', 'CAR_DIVING_SESSION.DS_CODE')
        ->where('CAR_DIVING_SESSION.DS_DATE', '>=', $after)
                ->where('CAR_DIVING_SESSION.DS_DATE', '<=', $before)
        ->groupBy('CAR_USER.us_id', 'CAR_USER.US_NAME', 'CAR_USER.US_FIRST_NAME')
        ->get();


        return view('alldiversactivities', ['datas' => $usersDatas]);

    }


    public function after(string $after): View
    {


        $usersDatas = DivingNumberModel::selectRaw('COUNT(*) as aggregate, CAR_USER.US_FIRST_NAME, CAR_USER.US_NAME')
        ->join('CAR_REGISTRATION', 'CAR_USER.us_id', '=', 'CAR_REGISTRATION.us_id')
        ->join('CAR_DIVING_SESSION', 'CAR_REGISTRATION.DS_CODE', '=', 'CAR_DIVING_SESSION.DS_CODE')
        ->where('CAR_DIVING_SESSION.DS_DATE', '>=', $after)
        ->groupBy('CAR_USER.us_id', 'CAR_USER.US_NAME', 'CAR_USER.US_FIRST_NAME')
        ->get();


        return view('alldiversactivities', ['datas' => $usersDatas]);

    }


    public function before(string $before): View
    {


        $usersDatas = DivingNumberModel::selectRaw('COUNT(*) as aggregate, CAR_USER.US_FIRST_NAME, CAR_USER.US_NAME')
        ->join('CAR_REGISTRATION', 'CAR_USER.us_id', '=', 'CAR_REGISTRATION.us_id')
        ->join('CAR_DIVING_SESSION', 'CAR_REGISTRATION.DS_CODE', '=', 'CAR_DIVING_SESSION.DS_CODE')
        ->where('CAR_DIVING_SESSION.DS_DATE', '<=', $before)
        ->groupBy('CAR_USER.us_id', 'CAR_USER.US_NAME', 'CAR_USER.US_FIRST_NAME')
        ->get();


        return view('alldiversactivities', ['datas' => $usersDatas]);

    }

}

