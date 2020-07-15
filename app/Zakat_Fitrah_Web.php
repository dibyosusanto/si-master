<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zakat_Fitrah_Web extends Model
{
    public function jamaah_web(){
        return $this->belongsTo('App\Jamaah_Web', 'id_jamaah', 'id_jamaah');
    }

    public function muzakki_web(){
        return $this->belongsTo('App\Muzakki_Web', 'id_jamaah', 'id_jamaah');
    }
}
