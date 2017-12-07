<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Models\BlockedUser;
use App\Models\Conversation;
use Carbon\Carbon;
use DB;
use Barryvdh\Debugbar\Facade as Debugbar;


class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'email', 'prenom','ville','password','date_inscription',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function blockeduser()
    {
        return $this->belongTo('App\Models\BlockedUser');
    }

    /**
     * Check if the user is blocked or not
     * @return boolean
     */
    public function isBlocked()
    {
        if ($this->is_blocked) {
            $now = Carbon::now();
            $result = BlockedUser::where('users_id', $this->id)->where('time_start','<', $now)->where('time_stop','>', $now)->get();
            if ($result->count()) {
                return true;
            }            
        }
        return false;
    }

    public function getConversations()
    {
        $conversations = Conversation::where('users1_id',$this->id)
                         ->orWhere('users2_id',$this->id)
                         ->get();

        return $conversations;
    }

    /**
     * Retrieve the current blockage
     * @return row_type_blocked_user 
     */
    public function getCurrentBlockage()
    {
        $now = Carbon::now();
        $result = BlockedUser::where('users_id', $this->id)
                            ->where('time_start','<', $now)
                            ->where('time_stop','>', $now)
                            ->orWhereNull('time_stop')
                            ->select('time_start','time_stop', 'comments')
                            ->get()
                            ->first();
        if ($result->count()) {
            return $result;
        }
        else
        {
            return NULL;
        }
    }

    public function getUnreadMessages()
    {
        $conversations = Conversation::where('users1_id',$this->id)
                         ->orWhere('users2_id',$this->id)
                         ->get();
        $nb_unread = 0;
        if ($conversations->count()) {
            foreach ($conversations as $conversation ) {
                $messages = Message::where('emmeteurs_id', '<>', $this->id)
                            ->where('conversations_id', $conversation->id)
                            ->where('lu',false)
                            ->get();
                $nb_unread += $messages->count();
            }
            return $nb_unread;
        }
        else
        {
            return -1;
        }
        
    }

    /**
     * Retrieve X last messages (where X equals nb_messages).
     * @param  int    $nb_message Nb messages to retrieve
     * @return [type]             [description]
     */
    public function getMessages( $nb_messages)
    {
        $conversations = DB::table('conversations')->select('id')->where('users1_id',$this->id)
                         ->orWhere('users2_id',$this->id)
                         ->get();
        $id_convs = array();
        foreach ($conversations as $conversation) {
            array_push($id_convs, $conversation->id);
        }
          
        $messages = Message::select('*')->whereIn('conversations_id', $id_convs)
        ->limit($nb_messages)->get();
       
        return $messages;        
    }

    /**
     * Check if the connected user has already a role.
     * @return boolean [description]
     */
    public function hasAnyRole()
    {
        $result = $this->hasRole(['teacher','student','parent']);
        return $result;
    }
}
