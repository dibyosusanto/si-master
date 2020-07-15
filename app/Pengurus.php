<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    
    protected $table = 'penguruses';
    protected $primaryKey = 'id_pengurus';
    protected $fillable = [
        'nama_pengurus', 'no_hp', 'alamat', 'id_masjid', 'id_user'
    ];

    protected $hidden = [
        'password'
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
    public function masjid(){
        return $this->belongsTo('App\Masjid', 'id_masjid', 'id_masjid');
    }

    public function akun(){
        return $this->hasOne('App\User', 'id', 'id_user');
    }
}
