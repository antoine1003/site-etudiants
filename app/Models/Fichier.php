<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    public function conversation()
    {
    	return $this->belongsToMany('App\Models\Conversation');
    }
}
