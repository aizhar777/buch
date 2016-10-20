<?php

namespace App;

use Illuminate\Http\Request;
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
    const TYPE = 'App\User';

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

    /**
     * Get all of the field's.
     */
    public function fields()
    {
        return $this->morphMany('App\Field', 'accessory');
    }

    /**
     * Get all of the requisite's.
     */
    public function requisites()
    {
        return $this->morphMany('App\Requisite', 'relation');
    }

    /**
     * Get all of the requisite's.
     */
    public function oversees()
    {
        return $this->hasMany('App\Client','curator','id');
    }

    public function subdivisions()
    {
        return $this->hasMany('App\Subdivision');
    }

    public function stock()
    {
        return $this->hasMany('App\Stock');
    }

    public function photos()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    public function createImage(Request $request)
    {
        if(!$request->hasFile('user_image'))
            return false;

        $file = $request->file('user_image');
        $destinationPath = base_path() . '/public/upload/images/';
        $image_name = time() . "_". $this->table . "_" . $file->getClientOriginalName();
        $userPhoto = $file->move($destinationPath , $image_name);

        $image = Image::create([
            'name' => 'User Image',
            'src' => $image_name,
            'alt' => 'User Image',
            'imageable_id' => $this->id,
            'imageable_type' => self::TYPE,
        ]);

        if($image instanceof Image){
            return true;
        }else{
            unlink($userPhoto->getPath());
            return false;
        }
    }

}
