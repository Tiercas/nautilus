<?php

namespace App\Http\Controllers;

use App\Models\RoleAttribution;
use App\Models\User;
use Illuminate\Http\Request;

class ManageAdherentController extends Controller {
    function index() {
        $users = User::select('car_user.US_ID', 'car_user.US_FIRST_NAME', 'car_user.US_NAME', 'car_role_attribution.ROL_CODE')->leftjoin('car_role_attribution', 'car_role_attribution.US_ID', '=', 'car_user.US_ID')->orderBy('car_user.US_ID')->get();

        $user_role = array();
        $usersInfos = array();

        foreach ($users as $user) {
            $usersInfos[$user->US_ID] = [$user->US_ID, $user->US_FIRST_NAME, $user->US_NAME];
            if (!array_key_exists($user->US_ID, $user_role)){
                $user_role[$user->US_ID] = array();
            }
            $user_role[$user->US_ID][] = $user->ROL_CODE;
        }
        $users = [$usersInfos, $user_role];

        return view('manageAdherent', ['users' => $users]);
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


}

