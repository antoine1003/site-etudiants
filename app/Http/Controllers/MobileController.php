<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MobileController extends Controller
{
    public function getAllUsers()
    {
        app('debugbar')->disable();
    	$users = User::all();
    	return json_encode($users);
    }

    public function getUserInfoById(Request $request)
    {
        app('debugbar')->disable();
        $id = $request->input('user_id');
        $token = $request->input('token_mobile');
    	if (config('custom_settings.token_mobile') == $token) {
    		$user = User::find($id);
            echo json_encode($user);
    	}
    	else
        {
    		echo "refused";
    	}
    }

    public function getUserInfoByEmail(Request $request)
    {
        app('debugbar')->disable();
        $email = $request->input('user_email');
        $token = $request->input('token_mobile');
        if (config('custom_settings.token_mobile') == $token) 
        {
            $user = User::where('email',$email)->first();
            if(empty($user))
            {
                echo "failed";
            }
            else
            {
                echo '['.json_encode($user).']';
            }
        }
        else
        {
            echo "refused";
        }
    }

    public function passwordUpdate(Request $request)
    {
        app('debugbar')->disable();
        if (config('custom_settings.token_mobile') == $request->input('token_mobile')) {
            $u = User::where('id', $request->input('id_user'))->first();
            if (isset($u) {
                $password_old = $request->input('password_old');
                $password_new = $request->input('password_new');
                if (Hash::check($request->input('password_old'), $u->password)) {
                    $u->password = bcrypt($password_new);
                    $u->save();
                    echo "success";                }
                else{
                    echo "failed";
                }
            }
            else
            {
                echo "failed";
            }
         }
        else
        {
            echo "refused";
        }
    }

    public function connection(Request $request)
    {
        app('debugbar')->disable();
    	if (config('custom_settings.token_mobile') == $request->input('token_mobile')) {
             $u = User::where('email', $request->input('email'))->first();

            if (isset($u)) {            
                if (Hash::check($request->input('password'), $u->password))
                {
                    if($u->verified)
                    {
                        if ($u->is_blocked) {
                            echo "blocked";
                        }
                        else
                        {
                            echo "success";
                        }
                    }
                    else
                    {
                        echo "unverified";
                    }
                   
                }
                else
                {
                    echo "failed";
                }
            }
            else{
                echo "failed";
            }
        }
        else
        {
            echo "refused";
        }
    }
}
