<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parent extends Model
{
    public function user()
    {
    	return $this->hasOne(User::class, 'id', 'users_id');
    }
}
