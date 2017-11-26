<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Models\BlockedUser;
use Carbon\Carbon;
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

    public function hasAnyRole()
    {
        $result = $this->hasRole(['teacher','student','parent']);
        return $result;
    }
}
