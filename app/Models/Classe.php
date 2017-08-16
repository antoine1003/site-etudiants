<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    public function etatsvalidation($value='')
    {
    	return $this->hasOne('App\Models\EtatsValidation', 'id', 'etats_validations_id');
    }
}
