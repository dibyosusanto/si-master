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

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }

    public function infaq_masjid(){
        return $this->hasMany('App\Infaq_Masjid', 'id_pengurus', 'id_pengurus');
    }

    public function infaq_web(){
        return $this->hasMany('App\Infaq_Web', 'id_pengurus', 'id_pengurus');
    }

    public function zakat_masjid(){
        return $this->hasMany('App\Zakat_Fitrah_Masjid', 'id_pengurus', 'id_pengurus');
    }

    public function zakat_web(){
        return $this->hasMany('App\Zakat_Fitrah_Web', 'id_pengurus', 'id_pengurus');
    }

    public function pengeluaran()
    {
        return $this->hasMany('App\Kas_Keluar', 'id_pengurus', 'id_pengurus');
    }

    public function announcements()
    {
        return $this->hasMany('App\Announcements', 'id_pengurus', 'id_pengurus');
    }
}
