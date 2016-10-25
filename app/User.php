<?php

namespace App;

use App\Library\Traits\CurrentUserModel;
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
    use Notifiable, Authenticatable, CanResetPassword, ShinobiTrait, CurrentUserModel;

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
        /*
        $currentUser = $this->getCurrentUser();

        if($currentUser->id == $this->id) {
            if (\Session::has('current.roles')) {
                $roles = session('current.roles');
            }else{
                $roles = $this->belongsToMany('\App\Role')->withTimestamps();
                \Session::put('current.roles',$roles);
            }
        }else{*/
            $roles = $this->belongsToMany('\App\Role')->withTimestamps();
        //}

        return $roles;
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

    public function trades()
    {
        return $this->hasMany('App\Trade','id', 'client_id');
    }

    public function completedTrades()
    {
        return $this->hasMany('App\Trade','id', 'completed_by_user');
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

    /**
     * Is current user
     *
     * @return bool
     */
    public function is_current()
    {
        if($this->getCurrentUser()->id == $this->id)
            return true;
        return false;
    }

}
