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

    public function connection(Request $request)
    {

    	if (config('custom_settings.token_mobile') == $request->input('token_mobile')) {
             $u = User::where('email', $request->input('email'))->first();

            if (isset($u)) {            
                if (Hash::check($request->input('password'), $u->password))
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
