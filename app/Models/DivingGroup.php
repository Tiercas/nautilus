<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DivingGroup extends Model
{
    protected $table = 'CAR_DIVING_GROUP';
    protected $fillable = 'DS_CODE';

    use HasFactory;

    public function getDivers(){
        $registrations = DivingSignUpModel::where('DS_CODE', $this->DS_CODE)->where('DG_NUMBER', $this->DG_NUMBER)->get();

        $divers = [];

        foreach($registrations as $registration){
            $divers[] = User::find($registration->US_ID);
        }

        return $divers;
    }
}
