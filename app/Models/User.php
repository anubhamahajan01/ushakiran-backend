<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject, CanResetPassword
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
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

    public static function boot()
	{
		parent::boot();

        static::creating(function($user) {
            $user->uuid = generate_uuid();
        });
    }

    public function getJWTIdentifier(){

        return $this->getKey();
    }

    public function getJWTCustomClaims(){

        return [];
    }

    public function donations()
    {
        return $this->hasMany(\App\Models\Donation::class, 'user_id');
    }

    public function educational_request()
    {
        return $this->hasMany(\App\Models\EducationalRequest::class, 'user_id');
    }

    public function shop_interests()
    {
        return $this->hasMany(\App\Models\ProductInterest::class, 'user_id');
    }

}
