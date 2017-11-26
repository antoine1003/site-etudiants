<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    public function matiereprofesseur()
    {
    	return $this->belongToMany('App\Models\MatiereProfesseur');
    }

    public function categorieclasseprofesseur()
    {
    	return $this->belongTo('App\Models\CategorieClasseProfesseur');
    }
}
