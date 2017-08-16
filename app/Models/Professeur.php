<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    public function user()
    {
    	return $this->hasOne('App\Models\User', 'id', 'users_id');
    }
}
