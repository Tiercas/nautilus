<?php

namespace App\Models;

use Error;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

/**
 * @method static select(string $string, string $string1, string $string2, string $string3, string $string4)
 */
class DivingSession extends Model
{
    protected $table = 'CAR_DIVING_SESSION';
    protected $primaryKey = 'DS_CODE';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $guarded = [];

    use HasFactory;

    static public function sessionsWithFilledFile():array
    {
        $res =  DB::table('CAR_DIVING_SESSION')->get();
        return $res->toArray();
    }

    static public function sessionsWithFilledFileWithId():array
    {
        $res =  DB::table('CAR_DIVING_SESSION')->where('US_ID_CAR_DIRECT',session('user')->US_ID)->get();
        return $res->toArray();
    }

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

    public function getDivingGroups(){
        return DivingGroup::where('DS_CODE', $this->DS_CODE)->get();
    }

    public static function disable($id)
    {
        $ds = DivingSession::find($id);

        if(($ds->DS_DATE < date('Y-m-d')) == 1)
        {
            return "Impossible de supprimer une plongée passée";
        }
        else
        {
            $ds->DS_ACTIVE = 0;
            $ds->save();
        }
    }

    public function getRoleForUser(User $user){
        if($user->US_ID === $this->US_ID_CAR_DIRECT){

            return "Directeur de plongée";

        }

        if($user->US_ID === $this->US_ID){

            return "Pilote";

        }

        if($user->US_ID === $this->US_ID_CAR_SECURE){

            return "Sécurité de surface";

        }

        if($user->US_TEACHING_LEVEL > 0){

            return "Encadrant";

        }

        if(strpos($user->PRE_CODE, 'GP')){

            return "Guide de palanquée";

        }

        return "Plongeur";

    }

    
}
