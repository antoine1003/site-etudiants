<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parent extends Model
{
    public function user()
    {
    	return $this->hasOne('App\Models\User', 'id', 'users_id');
    }

    public function eleve($value='')
    {
		return $this->belongsToMany('App\Models\Eleve');
    }
}
