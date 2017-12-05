<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function fichier()
    {
    	return $this->hasOne('App\Models\Fichier', 'id', 'fichiers_id');
    }

    public function users()
    {
    	return $this->hasOne('App\Models\User', 'id', 'emmeteurs_id');
    }

    public function conversation()
    {
    	return $this->belongTo('App\Models\Conversation');
    }
}
