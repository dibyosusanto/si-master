<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
}
