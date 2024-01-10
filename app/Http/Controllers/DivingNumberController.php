<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\DivingNumberModel;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DivingNumberController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        if ($user) {
            $userId = $user->US_ID;
        }else{
            $userId = 1;
        }
        
        $dives = 99;
        $usersCount = DivingNumberModel::join('car_registration', 'car_user.us_id', '=', 'car_registration.us_id')
            ->join('car_diving_group', function ($dg) {
                $dg->on('car_registration.ds_code', '=', 'car_diving_group.ds_code')
                    ->on('car_registration.dg_number', '=', 'car_diving_group.dg_number');
            })
            ->where('car_user.US_ID', $userId)
            ->count();
        $usersCount = 99 - $usersCount;

        return view('diveractivities', compact('usersCount'));
    }

    public function allIndex(Request $request): View
    {
        if($request['afterthe'] != '' and $request['beforethe'] != ''){
            return DivingNumberController::filteredSearch($request['afterthe'], $request['beforethe']);
        }
        $usersDatas = DivingNumberModel::selectRaw('COUNT(*) as aggregate, car_user.US_FIRST_NAME, car_user.US_NAME')
    ->join('car_registration', 'car_user.us_id', '=', 'car_registration.us_id')
    ->join('car_diving_group', function ($join) {
        $join->on('car_registration.ds_code', '=', 'car_diving_group.ds_code')
            ->on('car_registration.dg_number', '=', 'car_diving_group.dg_number');
    })
    ->groupBy('car_user.us_id', 'car_user.US_NAME', 'car_user.US_FIRST_NAME')
    ->get();

        return view('alldiversactivities', ['datas' => $usersDatas]);

    }

    public function filteredSearch(string $after, string $before): View
    {


        $usersDatas = DivingNumberModel::selectRaw('COUNT(*) as aggregate, car_user.US_FIRST_NAME, car_user.US_NAME')
        ->join('car_registration', 'car_user.us_id', '=', 'car_registration.us_id')
        ->join('car_diving_session', function ($join) {
            $join->on('car_registration.us_id', '=', 'car_diving_session.us_id');
        })
        ->where('car_diving_session.DS_DATE', '>', '"'.$after.'"')
        ->where('car_diving_session.DS_DATE', '>', '"'.$before.'"')
        ->groupBy('car_user.us_id', 'car_user.US_NAME', 'car_user.US_FIRST_NAME')
        ->tosql();

        /*select COUNT(*) as aggregate, car_user.US_FIRST_NAME, car_user.US_NAME
        from car_user
        join car_registration on car_user.us_id = car_registration.us_id
        join car_diving_session on car_registration.us_id = car_diving_session.us_id
        where '2022-9-30' < car_diving_session.DS_DATE
        and '2022-10-2' > car_diving_session.DS_DATE
        group by car_user.us_id, car_user.us_name, car_user.us_first_name;*/

        return view('alldiversactivities', ['datas' => $usersDatas]);

    }

}

