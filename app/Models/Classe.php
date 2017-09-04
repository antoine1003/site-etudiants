<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    public function etatsvalidation()
    {
    	return $this->hasOne('App\Models\EtatsValidation', 'id', 'etats_validations_id');
    }

    public function categorieclasse()
    {
    	return $this->hasOne('App\Models\CategorieClasse', 'id', 'categorie_classes_id');
    }
}
