<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'id_announcement';
    protected $guarded = [];
    
    public function pengurus()
    {
        return $this->belongsTo('App\Pengurus', 'id_pengurus', 'id_pengurus');
    }
}
