<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManageAdherentController extends Controller {
    function index() {
        $users = User::select('*')->join('car_role_attribution', 'car_role_attribution.US_ID', '=', 'car_user.US_ID')->orderBy('car_user.US_ID')->get();
        $user_role = array();
        $usersInfos = array();
        foreach ($users as $user) {
            $usersInfos[$user->US_ID] = [$user->US_ID, $user->US_FIRST_NAME, $user->US_NAME];
            if (!array_key_exists($user->US_ID, $user_role)){
                $user_role[$user->US_ID] = array();
            }
            array_push($user_role[$user->US_ID], $user->ROL_CODE);
        }
        $users = [$usersInfos, $user_role];
        return view('manageAdherent', ['users' => $users]);
    }

    function update(Request $request) {
        @dd($request->all());
        return redirect()->route('manage_members');
    }


}
