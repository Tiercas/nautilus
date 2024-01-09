<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'CAR_USER';

    protected $primaryKey = 'US_ID';

    /**
     * Check if a given password matches the stored password.
     *
     * @param string $password the password to try
     * @return bool true if the password matches, false otherwise
     */
    public function checkPassword($password)
    {
        if($password == $this->US_PASSWORD)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'CAR_ROLE_ATTRIBUTION', 'US_ID', 'ROL_CODE');
    }

    public function hasRole($roleCode)
    {
        return $this->roles->contains('ROL_CODE', $roleCode);
    }
}

?>
