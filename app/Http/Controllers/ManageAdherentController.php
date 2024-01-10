<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManageAdherentController extends Controller {
    function index() {
        $users = User::select('*')->join('car_role_attribution', 'car_role_attribution.US_ID', '=', 'car_user.US_ID')->orderBy('car_user.US_ID')->get();
        $user_role = array();
        $oldUserID = null;
        foreach ($users as $user) {
            $user_role[$user->US_ID] = [$user->US_ID, [], $user->US_FIRST_NAME . " " . strtoupper($user->US_NAME)];
            if ($oldUserID == $user->US_ID) {
                array_push($user_role[$user->US_ID][1], $user->ROL_CODE);
            } else {
                $user_role[$user->US_ID][1] = [$user->ROL_CODE];
            }
            $oldUserID = $user->US_ID;
        }
        return view('manageAdherent', ['user_role' => $user_role]);
    }

    function update(Request $request) {
        @dd($request->all());
        return redirect()->route('manage_members');
    }


}
