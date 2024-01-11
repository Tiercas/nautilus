<?php

namespace App\Http\Controllers;

use App\Models\RoleAttribution;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DivingNumberModel;

class ManageAdherentController extends Controller {
    function index() {
        $users = User::select('CAR_USER.US_ID', 'CAR_USER.US_FIRST_NAME', 'CAR_USER.US_NAME', 'CAR_ROLE_ATTRIBUTION.ROL_CODE')->leftjoin('CAR_ROLE_ATTRIBUTION', 'CAR_ROLE_ATTRIBUTION.US_ID', '=', 'CAR_USER.US_ID')->orderBy('CAR_USER.US_ID')->get();

        $user_role = array();
        $usersInfos = array();
        $userDives = array();

        foreach ($users as $user) {
            $usersInfos[$user->US_ID] = [$user->US_ID, $user->US_FIRST_NAME, $user->US_NAME];
            if (!array_key_exists($user->US_ID, $user_role)){
                $user_role[$user->US_ID] = array();
            }
            $user_role[$user->US_ID][] = $user->ROL_CODE;
            $usersCount = DivingNumberModel::join('CAR_REGISTRATION', 'CAR_USER.us_id', '=', 'CAR_REGISTRATION.us_id')
                ->join('CAR_DIVING_SESSION', 'CAR_REGISTRATION.ds_code', '=', 'CAR_DIVING_SESSION.ds_code')
                ->where('CAR_USER.us_id', $user->US_ID)
                ->whereYear('CAR_DIVING_SESSION.ds_date', '=', now()->year)
                ->count();
            $userDives[$user->US_ID] = $usersCount;
        }

        $users = [$usersInfos, $user_role];

        return view('manageAdherent', ['users' => $users, 'usersDives' => $userDives]);
    }

    function update(Request $request) {
        $uptUser = $request->all();
        RoleAttribution::truncate();
        foreach ($uptUser as $key => $value) {
            if ($key != '_token') {
                $roleAttribution = new RoleAttribution();
                $roleAttribution->US_ID = explode("_", $key)[1];
                $roleAttribution->ROL_CODE = $value;
                $roleAttribution->save();
            }
        }
        return redirect()->route('manage_members');
    }

    function updatePassword(Request $request){
        $user = session('user');
        dd( $request->OldPassword , $user->US_PASSWORD ,$user->checkPassword($request->OldPassword) );
        if ($user->checkPassword($request->OldPassword)){
            $user->US_PASSWORD = $request->newPassword;
            $user->save();
        }else{
            return redirect('/error');
        }
        return redirect('/');
    }
}

