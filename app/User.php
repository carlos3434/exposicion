<?php

namespace App;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Caffeinated\Shinobi\Facades\Shinobi;
use Caffeinated\Shinobi\Contracts\Permission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Caffeinated\Shinobi\Contracts\Role;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, HasRolesAndPermissions;
    //use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmailQueued);
    }

}
