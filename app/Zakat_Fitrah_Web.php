<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zakat_Fitrah_Web extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'id_zakat';
    public function jamaah_web(){
        return $this->belongsTo('App\Jamaah_Web', 'id_jamaah', 'id_jamaah');
    }

    public function muzakki_web(){
        return $this->hasMany('App\Muzakki_Web', 'id_zakat', 'id_zakat');
    }

    public function masjid(){
        return $this->belongsTo('App\Masjid', 'id_masjid', 'id_masjid');
    }

    public function pengurus(){
        return $this->belongsTo('App\Pengurus', 'id_pengurus', 'id_pengurus');
    }
}
