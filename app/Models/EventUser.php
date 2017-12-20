<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
	public $timestamps = false;
	
	public function user()
    {
    	return $this->hasOne('App\Models\User', 'id', 'users_id');
    }

    public function event()
    {
    	return $this->hasOne('App\Models\Event', 'id', 'events_id');
    }
}
