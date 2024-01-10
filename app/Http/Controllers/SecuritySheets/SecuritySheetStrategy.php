<?php

namespace App\Http\Controllers\SecuritySheets;

/**
 * A strategy (the design pattern) for security sheets generation.
 * @author Julien Ait azzouzene <aitazzo221@unicaen.fr>
 */
interface SecuritySheetStrategy{
    /**
     * Generates the PDF sheet.
     * @param $html the HTML code to generate the document with
     * @param $ds_code the code of the diving session
     * @return string the content to display on the page
     */
    public function generatePdf($html, $ds_code);
}