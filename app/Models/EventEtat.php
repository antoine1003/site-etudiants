<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventEtat extends Model
{
	public $timestamps = false;
	
    public function event()
    {
		return $this->belongTo('App/Models/Event');    	
    }
}
