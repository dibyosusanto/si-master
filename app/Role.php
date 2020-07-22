<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function pengguna()
    {
        return $this->hasMany('App\User', 'role', 'id');
    }
}
