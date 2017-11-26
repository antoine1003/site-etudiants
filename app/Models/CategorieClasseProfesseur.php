<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieClasseProfesseur extends Model
{
	
    public function professeur()
    {
    	return $this->hasOne('App\Models\Professeur');
    }

    public function matiere()
    {
    	return $this->hasOne('App\Models\Matiere');
    }

    public function categorieclasse()
    {
    	return $this->hasOne('App\Models\CategorieClasse');
    }
}
