<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Infaq_Web extends Model
{
    protected $primaryKey = 'id_infaq';
    protected $guarded = [];
    public function jamaah_web(){
        return $this->belongsTo('App\Jamaah_Web', 'id_jamaah', 'id_jamaah');
    }
}
