<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zakat_Fitrah_Masjid extends Model
{
    protected $primaryKey = 'id_zakat';
    protected $guarded = [];
    public function jamaah_masjid(){
        return $this->belongsTo('App\Jamaah_Masjid', 'id_jamaah', 'id_jamaah');
    }

    public function masjid(){
        return $this->belongsTo('App\Masjid', 'id_masjid', 'id_masjid');
    }

    public function pengurus(){
        return $this->belongsTo('App\Pengurus', 'id_pengurus', 'id_pengurus');
    }

    public function muzakki_masjid(){
        return $this->hasMany('App\Muzakki_Masjid', 'id_zakat', 'id_zakat');
    }
}
