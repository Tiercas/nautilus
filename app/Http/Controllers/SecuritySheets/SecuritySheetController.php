<?php

namespace App\Http\Controllers\SecuritySheets;

use App\Models\User;
use App\Models\DivingGroup;
use Illuminate\Http\Request;
use App\Models\DivingSession;
use App\Models\DivingLocation;
use Illuminate\Support\Facades\Log;
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
        $html =  self::callView($ds_code, 'securitySheet.pdf');
        return $this->strategy->generatePdf($html, $ds_code);
    }

    /**
     * Shows a edition form for the security sheet of the specified diving session.
     * @param string $ds_code the code of the diving session
     * @return string a view of the editing form
     */
    public function edit(string $ds_code){
        return self::callView($ds_code, 'securitySheet.edit');
    }

    /**
     * Updates the diving session and each of its diving groups based on the editing form.
     * Also generates the corresponding pdf file.
     * @param string $ds_code the code of the diving session
     * @param Request $request the HTTP request received by the server
     */
    public function update(string $ds_code, Request $request){
        $data = $request->json()->all();

        Log::info($data);

        $divingSession = DivingSession::find($ds_code);
        $divingSession->DS_OBSERVATION_FIELD = $data['observation'];
        $divingSession->save();

        foreach($data as $groupNumber => $groupData){
            if(! is_array($groupData)){
                continue;
            }
            self::updateDivingGroup($ds_code, $groupNumber, $groupData);
        }

        self::setStrategy(new StoreSilentStrategy);
        self::generate($ds_code);
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
    private function callView(string $ds_code, string $viewName){
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

        return view($viewName, [
            'dive' => $dive,
            'director' => $director,
            'surfaceSecurity' => $surfaceSecurity,
            'driver' => $driver,
            'location' => $location,
            'divingGroups' => $divingGroupsForView
        ]);
    }

    /**
     * Update a single diving group.
     * @param string $ds_code
     */
    private function updateDivingGroup(string $ds_code, $dg_number, array $divingGroup){
        DivingGroup::where('DS_CODE', $ds_code)
            ->where('DG_NUMBER', $dg_number)
            ->update([
                'DG_BEGINNING_OF_DIVING_HOUR' => $divingGroup['dg-start'],
                'DG_END_OF_DIVING_HOUR' => $divingGroup['dg-end'],
                'DG_MAX_DURATION' => $divingGroup['dg-exp-time'],
                'DG_MAX_DEPTH' => $divingGroup['dg-exp-dep'],
                'DG_EFFECTIVE_DIVING_DURATION' => $divingGroup['dg-act-time'],
                'DG_MAX_EFFECTIVE_DEPTH' => $divingGroup['dg-act-dep']
            ]);
    }
}
