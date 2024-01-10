<?php

namespace App\Http\Controllers\SecuritySheets;

interface SecuritySheetStrategy{
    public function generatePdf($html, $ds_code);
}