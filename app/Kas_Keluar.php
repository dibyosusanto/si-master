<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kas_Keluar extends Model
{
    protected $primaryKey = 'id_pengeluaran';
    protected $guarded = [];
    
    public function masjid(){
        return $this->belongsTo('App\Masjid', 'id_masjid', 'id_masjid');
    }

    public function pengurus(){
        return $this->belongsTo('App\Pengurus', 'id_pengurus', 'id_pengurus');
    }
}
