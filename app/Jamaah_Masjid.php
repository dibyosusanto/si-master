<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jamaah_Masjid extends Model
{
    protected $guarded = [];
    protected $table = 'jamaah__masjids';
    protected $primaryKey = 'id_jamaah';
    public function masjid()
    {
        return $this->belongsTo('App\Masjid', 'id_masjid', 'id_masjid');
    }

}
