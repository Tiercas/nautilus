<?php

namespace App\Http\Controllers\SecuritySheets;

use Spipu\Html2Pdf\Html2Pdf;

/**
 * A strategy that stores the document on the server, and make it public.
 * It displays 'OK' after successfully generating the file.
 * @implements SecuritySheetStrategy
 */
class StoreSilentStrategy implements SecuritySheetStrategy{
    /**
     * Generates the PDF sheet and store it as a file on the server.
     * @param $html the HTML code to generate the document with
     * @param $ds_code the code of the diving session
     * @return string 'OK' to tell the generation was successful
     */
    public function generatePdf($html, $ds_code){
        $html2pdf = new Html2Pdf();

        $html2pdf->writeHTML($html);

        $path = defined('PUBLIC_PATH') ? PUBLIC_PATH : '../www-dev/';
        
        $fileName = 'security-sheets/fiche-securite-' . $ds_code . '.pdf';

        $html2pdf->output(__DIR__ . '/../../../../' . $path . $fileName, 'F');
        
        return 'OK';
    }
}