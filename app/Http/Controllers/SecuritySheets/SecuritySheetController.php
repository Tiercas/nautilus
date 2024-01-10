<?php

declare(strict_types=1);

namespace App\Http\Controllers\SecuritySheets;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DivingSession;
use App\Models\DivingLocation;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SecuritySheets\StoreSilentStrategy;

class SecuritySheetController extends Controller
{
    private SecuritySheetStrategy $strategy;

    public function __construct(){
        $this->strategy = new StoreSilentStrategy;
    }

    public function generate(string $ds_code){
        $html =  self::callPdfBuilderView($ds_code);
        return $this->strategy->generatePdf($html, $ds_code);
    }

    public function show(string $ds_code){
       
    }

    public function setStrategy(SecuritySheetStrategy $strategy){
        $this->strategy = $strategy;
        return $this;
    }

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
