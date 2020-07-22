<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Jamaah_Masjid extends Model
{
    protected $guarded = [];
    protected $table = 'jamaah__masjids';
    protected $primaryKey = 'id_jamaah';
    public function masjid()
    {
        return $this->belongsTo('App\Masjid', 'id_masjid', 'id_masjid');
    }

    public function infaq_masjid(){
        return $this->hasMany('App\Infaq_Masjid', 'id_jamaah', 'id_jamaah');
    }

    public function zakat_masjid(){
        return $this->hasMany('App\Zakat_Fitrah_Masjid', 'id_jamaah', 'id_jamaah');
    }

    public function getAgeAtrribute()
    {
        return \Carbon::parse($this->atrributes['tgl_lahir'])->age;
    }

    
}
