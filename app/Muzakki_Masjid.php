<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Muzakki_Masjid extends Model
{
    protected $primaryKey = 'id_muzakki';
    protected $guarded = [];
    public function zakat_masjid(){
        return $this->belongsTo('App\Zakat_Fitrah_Masjid', 'id_zakat', 'id_zakat');
    }
}
