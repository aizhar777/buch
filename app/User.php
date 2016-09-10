<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Notifications\SentEmailLink as ResetPasswordNotification;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Notifiable, Authenticatable, CanResetPassword, ShinobiTrait;

    /**
     * Type of relations
     *
     * @var string
     */
    public $type = 'App\User';

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
     * Users can have many roles.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function roles()
    {
        return $this->belongsToMany('\App\Role')->withTimestamps();
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
