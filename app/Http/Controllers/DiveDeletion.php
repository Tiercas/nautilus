<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiveDeletion extends Controller
{
    public static function delete($id)
    {
        DiveSessionDelete::update($id);
        $previousDives = session('previousDives', []);

        $indexToRemove = array_search($id, array_column($previousDives, 'DS_CODE'));

        if ($indexToRemove !== false) {
            unset($previousDives[$indexToRemove]);
            $previousDives = array_values($previousDives);
            session(['previousDives' => $previousDives]);
        }
    }
}
