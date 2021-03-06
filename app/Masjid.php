<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masjid extends Model
{
    protected $primaryKey = 'id_masjid';
    protected $guarded = [];
    public function pengurus(){
        return $this->hasMany('App\Pengurus', 'id_masjid', 'id_masjid');
    }
    public function jamaah()
    {
        return $this->hasMany('App\Jamaah_Masjid', 'id_masjid', 'id_masjid');
    }

    public function infaq_masjid(){
        return $this->hasMany('App\Infaq_Masjid', 'id_masjid', 'id_masjid');
    }
    
    public function zakat_masjid(){
        return $this->hasMany('App\Zakat_Fitrah_Masjid', 'id_masjid', 'id_masjid');
    }

    public function infaq_web(){
        return $this->hasMany('App\Infaq_Web', 'id_masjid', 'id_masjid');
    }

    public function zakat_web(){
        return $this->hasMany('App\Zakat_Fitrah_Web', 'id_masjid', 'id_masjid');
    }

    public function pengeluaran()
    {
        return $this->hasMany('App\Kas_Keluar', 'id_masjid', 'id_masjid');
    }
}
