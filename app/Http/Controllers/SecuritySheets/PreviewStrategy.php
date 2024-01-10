<?php

namespace App\Http\Controllers\SecuritySheets;

/**
 * A strategy that simply returns the HTML code so that it's displayed on the web page as a preview.
 * It's mostly used for testing without generating and downloading the PDF file.
 * @implements SecuritySheetStrategy
 */
class PreviewStrategy implements SecuritySheetStrategy{

    /**
     * Returns the HTML code for it to be displayed.
     * @param $html the HTML code of the document
     * @param $ds_code the code of the diving session (unused, included for compatibility with the interface method)
     * @return string the exact same HTML code
     */
    public function generatePdf($html, $ds_code){
        return $html;
    }
}