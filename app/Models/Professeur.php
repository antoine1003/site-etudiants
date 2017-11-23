<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    public function user()
    {
    	return $this->hasOne('App\Models\User');
    }

    public function matiereprofesseur()
    {
    	return $this->belongTo('App\Models\MatiereProfesseur');
    }
}
