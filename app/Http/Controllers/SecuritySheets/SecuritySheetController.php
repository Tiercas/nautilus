<?php

declare(strict_types=1);

namespace App\Http\Controllers\SecuritySheets;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DivingSession;
use App\Models\DivingLocation;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SecuritySheets\StoreSilentStrategy;

/**
 * A controller for generating and previewing PDF security sheets.
 * @author Julien Ait azzouzene <aitazzo221@unicaen.fr>
 */
class SecuritySheetController extends Controller
{
    private SecuritySheetStrategy $strategy;

    public function __construct(){
        $this->strategy = new StoreSilentStrategy;
    }

    /**
     * Generates a security sheet for a particular diving session.
     * The action performed with this security sheet will depend of the strategy set (storing the file by default).
     * @param $ds_code the code of the diving session to generate the security sheet of
     * @return string|\View what to display on the page (what the strategy returns) 
     */
    public function generate(string $ds_code){
        $html =  self::callPdfBuilderView($ds_code);
        return $this->strategy->generatePdf($html, $ds_code);
    }

    /**
     * Sets the strategy for the security sheet and returns this instance.
     * @param $strategy the strategy
     * @return self
     */
    public function setStrategy(SecuritySheetStrategy $strategy){
        $this->strategy = $strategy;
        return $this;
    }

    /**
     * Build HTML from a view to generate the PDF sheet.
     * @param $ds_code the code of the diving session
     * @return string the HTML code
     */
    private function callPdfBuilderView(string $ds_code){
        $dive = DivingSession::find($ds_code);

        $director = User::find($dive->US_ID_CAR_DIRECT);
        $surfaceSecurity = User::find($dive->US_ID_CAR_SECURE);
        $driver = User::find($dive->US_ID);

        $location = DivingLocation::find($dive->DL_ID);

        $divingGroups = $dive->getDivingGroups();

        $divingGroupsForView = [];

        foreach($divingGroups as $divingGroup){
            $divingGroupsForView[] = [
                'group' => $divingGroup,
                'divers' => $divingGroup->getDivers()
            ];
        }

        return view('securitySheet.pdf', [
            'dive' => $dive,
            'director' => $director,
            'surfaceSecurity' => $surfaceSecurity,
            'driver' => $driver,
            'location' => $location,
            'divingGroups' => $divingGroupsForView
        ]);
    }
}
