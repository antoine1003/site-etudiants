<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        $id = $request->input('user_id');
        $id = $request->input('token_mobile');
    	if (config('custom_settings.token_mobile') == $token) {
    		$user = User::find($id);
            echo json_encode($user);
    	}
    	else{
    		abort(403);
    	}
    }

    public function connection(Request $request)
    {
        $token = $request->input('token_mobile');
    	if (config('custom_settings.token_mobile') == $token) {
            $email = $request->input('email');
            $password = bcrypt($request->input('password'));
            $nb = User::where('email',$email)->where('password',$password)->count();
            if ($nb == 1) {
                echo "success";
            }
            else
            {
                echo "failed";
            }
        }
        else{
            abort(403);
        }
    }
}
