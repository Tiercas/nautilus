<?php

namespace App\Http\Controllers\DataController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class DataRoleController extends Controller
{
    public static function fetch()
    {
        $roleData = Role::all();
        return $roleData;
    }
}
