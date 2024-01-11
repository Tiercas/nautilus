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
        if (session()->has('user')) {
            $userId = session('user')->US_ID; // Récupérer l'ID de l'utilisateur connecté

            // Faire quelque chose avec l'utilisateur ou son ID
        } else {
            $userId = NULL;
        }

        $dateDives = DivingNumberModel::join('CAR_REGISTRATION ', 'CAR_USER.us_id', '=', 'CAR_REGISTRATION .us_id')
        ->join('CAR_DIVING_LOCATION ','CAR_REGISTRATION .ds_code','=','CAR_DIVING_LOCATION .ds_code')
        ->join('CAR_DIVING_LOCATION ','CAR_DIVING_LOCATION .dl_id','=','CAR_DIVING_LOCATION .dl_id')
        ->join('CAR_ROLE_ATTRIBUTION ','CAR_USER.us_id','=','CAR_ROLE_ATTRIBUTION .Us_id')
        ->join('CAR_ROLE ','CAR_ROLE_ATTRIBUTION .rol_code','=','CAR_ROLE .rol_code')

        ->where('CAR_USER.US_ID',$userId)
        ->get();


        $usersCount = DivingNumberModel::join('CAR_REGISTRATION ', 'CAR_USER.us_id', '=', 'CAR_REGISTRATION .us_id')
            ->join('car_diving_group', function ($dg) {
                $dg->on('CAR_REGISTRATION .ds_code', '=', 'car_diving_group.ds_code')
                    ->on('CAR_REGISTRATION .dg_number', '=', 'car_diving_group.dg_number');
            })
            ->join('CAR_DIVING_LOCATION ','CAR_REGISTRATION .ds_code','=','CAR_DIVING_LOCATION .ds_code')
            ->where('CAR_DIVING_LOCATION .ds_date','>=',date("Y").'-00-00')
            ->where('CAR_USER.US_ID', $userId)
            ->orderBy('ds_date','desc')
            ->count();
        $usersCount = 99 - $usersCount ;

        return view('diveractivities', compact('usersCount'), ['dates' => $dateDives]);
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
    ->join('CAR_REGISTRATION ', 'CAR_USER.us_id', '=', 'CAR_REGISTRATION .us_id')
    ->join('car_diving_group', function ($join) {
        $join->on('CAR_REGISTRATION .ds_code', '=', 'car_diving_group.ds_code')
            ->on('CAR_REGISTRATION .dg_number', '=', 'car_diving_group.dg_number');
    })
    ->groupBy('CAR_USER.us_id', 'CAR_USER.US_NAME', 'CAR_USER.US_FIRST_NAME')
    ->get();

        return view('alldiversactivities', ['datas' => $usersDatas]);

    }

    public function afterAndBefore(string $after, string $before): View
    {


        $usersDatas = DivingNumberModel::selectRaw('COUNT(*) as aggregate, CAR_USER.US_FIRST_NAME, CAR_USER.US_NAME')
        ->join('CAR_REGISTRATION ', 'CAR_USER.us_id', '=', 'CAR_REGISTRATION .us_id')
        ->join('CAR_DIVING_LOCATION ', 'CAR_REGISTRATION .DS_CODE', '=', 'CAR_DIVING_LOCATION .DS_CODE')
        ->where('CAR_DIVING_LOCATION .DS_DATE', '>=', $after)
                ->where('CAR_DIVING_LOCATION .DS_DATE', '<=', $before)
        ->groupBy('CAR_USER.us_id', 'CAR_USER.US_NAME', 'CAR_USER.US_FIRST_NAME')
        ->get();


        return view('alldiversactivities', ['datas' => $usersDatas]);

    }


    public function after(string $after): View
    {


        $usersDatas = DivingNumberModel::selectRaw('COUNT(*) as aggregate, CAR_USER.US_FIRST_NAME, CAR_USER.US_NAME')
        ->join('CAR_REGISTRATION ', 'CAR_USER.us_id', '=', 'CAR_REGISTRATION .us_id')
        ->join('CAR_DIVING_LOCATION ', 'CAR_REGISTRATION .DS_CODE', '=', 'CAR_DIVING_LOCATION .DS_CODE')
        ->where('CAR_DIVING_LOCATION .DS_DATE', '>=', $after)
        ->groupBy('CAR_USER.us_id', 'CAR_USER.US_NAME', 'CAR_USER.US_FIRST_NAME')
        ->get();


        return view('alldiversactivities', ['datas' => $usersDatas]);

    }


    public function before(string $before): View
    {


        $usersDatas = DivingNumberModel::selectRaw('COUNT(*) as aggregate, CAR_USER.US_FIRST_NAME, CAR_USER.US_NAME')
        ->join('CAR_REGISTRATION ', 'CAR_USER.us_id', '=', 'CAR_REGISTRATION .us_id')
        ->join('CAR_DIVING_LOCATION ', 'CAR_REGISTRATION .DS_CODE', '=', 'CAR_DIVING_LOCATION .DS_CODE')
        ->where('CAR_DIVING_LOCATION .DS_DATE', '<=', $before)
        ->groupBy('CAR_USER.us_id', 'CAR_USER.US_NAME', 'CAR_USER.US_FIRST_NAME')
        ->get();


        return view('alldiversactivities', ['datas' => $usersDatas]);

    }

}

