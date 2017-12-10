<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Message;
use DB;

class Conversation extends Model
{
    public $nb_unread_conv;
    public function users()
    {
    	return $this->hasMany('App\Models\User');
    }

    public function messages()
    {
    	return $this->belongToMany('App\Models\Message');
    }
}
