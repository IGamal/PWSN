<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    /**
     * public function getRouteKeyName()
     * {
     *      return 'slug';
     * }
     */

   //The attributes that are mass assignable.
    protected $fillable = ['first_name', 'last_name', 'email', 'email_verified_at', 'password', 'phone', 'birthday',
                            'image', 'verified', 'verification_token', 'admin'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Function to help check if the user is verified or not.
    public function isVerified()
    {
        return $this->verified == User::VERIFIED_USER;
    }

    //Function to help check if the user is admin or not.
    public function isAdmin()
    {
        return $this->admin == User::ADMIN_USER;
    }

    //Function to help to generate code to verify user email.
    public static function generateVerificationCode()
    {
        return str_random(40);
    }

    public function fullName()
    {
        return $this->first_name .' '. $this->last_name;
    }

    //The Relation With Category Model.
    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }

    //The Relation With Article Model.
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    //The Relation With Donation Model.
    public function donations()
    {
        return $this->hasMany('App\Models\Donation');
    }

    //The Relation With Job Model.
    public function jobs()
    {
        return $this->hasMany('App\Models\Job');
    }

    //The Relation With News Model.
    public function news()
    {
        return $this->hasMany('App\Models\News');
    }

    //The Relation With Education Model.
    public function educations()
    {
        return $this->hasMany('App\Models\Education');
    }

    //The Relation With Comment Model.
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    //The Relation With Reply Model.
    public function replies()
    {
        return $this->hasMany('App\Models\Reply');
    }

    //The Relation With Like Model.
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    //The Relation With Favourite Model.
    public function favourites()
    {
        return $this->hasMany('App\Models\Favourite');
    }

    //The Relation With Save Model.
    public function saves()
    {
        return $this->hasMany('App\Models\Save');
    }
}
