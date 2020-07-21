<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Muzakki_Web extends Model
{
    protected $primaryKey = 'id_muzakki';
    protected $guarded = [];
    public function zakat_web(){
        return $this->belongsTo('App\Zakat_Fitrah_Web', 'id_zakat', 'id_zakat');
    }
}
