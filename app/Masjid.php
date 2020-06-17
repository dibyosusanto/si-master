<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masjid extends Model
{
    protected $primaryKey = 'id_masjid';
    protected $guarded = [];
    public function pengurus(){
        return $this->hasMany('App\Pengurus');
    }
    
}
