<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Muzakki_Web extends Model
{
    public function masjid(){
        return $this->belongsTo('App\Masjid');
    }
}
