<?php

namespace App\Http\Controllers\DataController;

use App\Http\Controllers\Controller;
use App\Models\Prerogative;

class DataPrerogativeController extends Controller
{
    public static function fetch()
    {
        $prerogative = Prerogative::all();
        return $prerogative;
    }
}
