<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EtatsValidation extends Model
{
    public function classe()
    {
    	return $this->belongsTo('App\Models\Classe');
    }

    public function matiere()
    {
    	return $this->belongsTo('App\Models\Matiere');
    }

}
