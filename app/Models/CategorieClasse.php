<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieClasse extends Model
{
    public function classe()
    {
    	return $this->belongTo('App\Models\Classe');
    }
}
