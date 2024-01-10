<?php

namespace App\Http\Controllers\SecuritySheets;

class PreviewStrategy implements SecuritySheetStrategy{
    public function generatePdf($html, $ds_code){
        return $html;
    }
}