<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    public function user()
    {
    	return $this->hasOne('App\Models\User', 'id', 'users_id');
    }

        public function eleve()
    {
		return $this->belongsToMany('App\Models\Parent');
    }
}
