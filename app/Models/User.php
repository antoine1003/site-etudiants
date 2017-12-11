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
     * Vérifie si l'utilisateur connecté est bloqué ou non.
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

    /**
     * Renvois les conversations concernant l'utilisateur connecté.
     * @return Conversation [description]
     */
    public function getConversations()
    {
        $conversations = Conversation::where('users1_id',$this->id)
                         ->orWhere('users2_id',$this->id)
                         ->get();

        return $conversations;
    }

    public function getConversationsWithFullnameAndUnread()
    {
        $conversations = DB::select(DB::raw('SELECT conversations.id, u2.id as u2_id, CONCAT(u2.prenom," ", u2.nom) as u2_nom_complet, u1.id as u1_id, CONCAT(u1.prenom," ", u1.nom) as u1_nom_complet FROM conversations JOIN users  u1 ON conversations.users1_id = u1.id JOIN users u2 ON conversations.users2_id = u2.id WHERE users1_id = ? OR users2_id = ?'), [$this->id,$this->id]);
        foreach ($conversations as $conversation) {
            $conversation->nb_unread_conv = $this->getUnreadMessagesInConv($conversation->id);
        }

        return $conversations;
    }

    /**
     * Renvois le blockage en cours
     * @return BlockedUser 
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

    /**
     * Retourne le nombre de messagesnon lus
     * @return int [description]
     */
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
     * Renvois les N derniers messages
     * @param  int    $nb_message Nb de messages à retourner.
     * @return Message             [description]
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
     * Retourne tous les messages d'une conversation
     * @param  int $nb_messages Nombre de messages à retourner
     * @param  int $id_conv     Id conversation
     * @return Message              [description]
     */
    public function getMessagesInConv( $nb_messages, $id_conv)
    {
          
        $messages = Message::select('*')->where('conversations_id', $id_conv)
        ->limit($nb_messages)->get();
       
        return $messages;        
    }

    /**
     * Retourne le nombre de messages non lus dans une conversation
     * @param  int $id_conv ID de la conversation
     * @return Message          [description]
     */
    public function getUnreadMessagesInConv($id_conv)
    {
        $messages = Message::where('conversations_id',$id_conv)
                    ->where('emmeteurs_id','<>',$this->id)
                    ->where('lu',false)
                    ->get();

        return $messages->count();
    }

    /**
     * Vérifie si l'utilisateur a un rôle
     * @return boolean [description]
     */
    public function hasAnyRole()
    {
        $result = $this->hasRole(['teacher','student','parent']);
        return $result;
    }
}
