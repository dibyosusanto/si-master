<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jamaah_Web extends Model
{
    protected $table = 'jamaah__webs';
    protected $primaryKey = 'id_jamaah';
    protected $fillable = [
        'nama_jamaah', 'alamat', 'tgl_lahir', 'no_hp', 'jenis_kelamin', 'id_user'
    ];

    protected $hidden = [
        'password'
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function infaq_web(){
        return $this->hasMany('App\Infaq_Web', 'id_jamaah', 'id_jamaah');
    }

    public function zakat_web(){
        return $this->hasMany('App\Infaq_Web', 'id_jamaah', 'id_jamaah');
    }

   public function user()
   {
       return $this->belongsTo('App\User', 'id_user', 'id');
   }
}
