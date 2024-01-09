<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class DivingSession extends Model
{
    protected $table = 'car_diving_session';
    protected $primaryKey = 'DS_CODE';
    protected $keyType = 'string';
    public $timestamps = false;

    use HasFactory;

    public function getParticipants(): array{
        $registrations = DB::table('CAR_REGISTRATION')->where('DS_CODE', $this->DS_CODE)->get();
        $participants = [];

        foreach($registrations as $registration){
            if($registration->REG_ACTIVE === 1){
                $participants[] = User::find($registration->US_ID);
            }
        }

        return $participants;
    }
}
