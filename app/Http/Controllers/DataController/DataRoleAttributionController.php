<?php

namespace App\Http\Controllers\DataController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleAttribution;

class DataRoleAttributionController extends Controller
{
    public static function fetch()
    {
        $roleAttributionData = RoleAttribution::all();
        return $roleAttributionData;
    }
}
