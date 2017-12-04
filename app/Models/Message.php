<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function fichier()
    {
    	return $this->hasOne('App\Models\Fichier', 'id', 'fichiers_id');
    }
}
