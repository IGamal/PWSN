<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    use SoftDeletes;

    /**
     * public function getRouteKeyName()
     * {
     *      return 'slug';
     * }
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * Function to help check if the user is verified or not
     */
    public function isVerified()
    {
        return $this->verified == User::VERIFIED_USER;
    }
    /**
     * Function to help check if the user is admin or not
     */
    public function isAdmin()
    {
        return $this->admin == User::ADMIN_USER;
    }
    /**
     * Function to help to generate code to verify user email
     */
    public static function generateVerificationCode()
    {
        return str_random(40);
    }
}
