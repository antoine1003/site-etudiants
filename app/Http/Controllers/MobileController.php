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

    public function connection(Request $request,$email,$password,$token)
    {

    	if (config('custom_settings.token_mobile') == $token) {
             $u = User::where('email', $email)->first();

            if (isset($u)) {            
                if (Hash::check($password, $u->password))
                {
                    echo "success";
                }
                else
                {
                    echo "failed";
                }
            }
            else{
                echo "refused";
            }
        }
    }
}
