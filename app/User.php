<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'role',
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

    public function pengurus()
    {
        return $this->hasOne('App\Pengurus', 'id_user', 'id');
    }

    public function jamaah_web()
    {
        return $this->hasOne('App\Jamaah_Web', 'id_user', 'id');
    }

    public function jenis_akses()
    {
        return $this->belongsTo('App\Role', 'role', 'id');
    }
}
