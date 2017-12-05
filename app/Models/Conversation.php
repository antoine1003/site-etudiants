<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function users()
    {
    	return $this->hasMany('App\Models\User');
    }

    public function messages()
    {
    	return $this->belongToMany('App\Models\Message');
    }
}
