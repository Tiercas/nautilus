<?php

namespace App\Http\Controllers\SecuritySheets;

use Spipu\Html2Pdf\Html2Pdf;

class StoreSilentStrategy implements SecuritySheetStrategy{
    public function generatePdf($html, $ds_code){
        $html2pdf = new Html2Pdf();

        $html2pdf->writeHTML($html);

        $path = defined('PUBLIC_PATH') ? PUBLIC_PATH : '../www-dev/';
        
        $fileName = 'security-sheets/fiche-securite-' . $ds_code . '.pdf';

        $html2pdf->output(__DIR__ . '/../../../../' . $path . $fileName, 'F');
        
        return 'OK';
    }
}