<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Message;
use DB;

class Conversation extends Model
{
    public function users()
    {
    	return $this->hasMany('App\Models\User');
    }

    public function messages()
    {
    	return $this->belongToMany('App\Models\Message');
    }

    public function getUnreadMessageWithUser($id_connected_user)
    {
    	$messages = DB::table('classe')
    				->where('conversations_id',$this->id)
    				->where('emmeteurs_id','<>',$id_connected_user)
    				->where('lu',false)
    				->get();

    	return $messages->count();
    }
}
