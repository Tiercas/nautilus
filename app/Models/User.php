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

    /**
     * Get the roles attributed to the user.
     */

    public function roles()
    {
        return $this->belongsToMany(Role::class, RoleAttribution::class, 'US_ID', 'ROL_CODE');
    }

    /**
     * Check if the user has a given role.
     *
     * @param string $roleCode the code of the role to check
     * @return bool true if the user has the role, false otherwise
     */
    public function hasRole($roleCode)
    {
        return $this->roles->contains('ROL_CODE', $roleCode);
    }
}

?>
