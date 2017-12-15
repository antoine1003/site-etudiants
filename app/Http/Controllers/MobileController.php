<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
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
    	}
    	else
        {
    		echo "refused";
    	}
    }

    public function getConversationsWithFullname(Request $request)
    {
        app('debugbar')->disable();
        $id = $request->input('id_user');
        $token = $request->input('token_mobile');
        if (config('custom_settings.token_mobile') == $token) {            
            $user = User::find($id);
            if ($user != null) {                
                $conversations = $user->getConversationsWithFullnameAndUnread();
                echo json_encode($conversations);
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
            if (isset($u)) {
                $password_old = $request->input('password_old');
                $password_new = $request->input('password_new');
                if (Hash::check($request->input('password_old'), $u->password)) {
                    $u->password = bcrypt($password_new);
                    $u->save();
                    echo "success";                
                }
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

    public function addMessageInConversation(Request $request)
    {
        app('debugbar')->disable();
        if (config('custom_settings.token_mobile') == $request->input('token_mobile')) {
            $id_user = $request->input('id_user');
            $id_conv = $request->input('id_conv');
            $id_fichier = $request->input('id_fichier');
            $contenu = $request->input('contenu');
            if (isset($id_user) && isset($id_conv) && isset($id_fichier) && isset($contenu)) {
               
                $message = new Message;
                $message->conversations_id = $id_conv;
                $message->emmeteurs_id = $id_user;
                if ($id_fichier != -1) {
                    $message->fichiers_id = $id_fichier;
                }                
                $message->contenu = $contenu;
                $message->save();
                echo "success";
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
    

    public function getMessagesByUserWithConv(Request $request)
    {
        app('debugbar')->disable();
        if (config('custom_settings.token_mobile') == $request->input('token_mobile')) {
            $id_user = $request->input('id_user');
            if (isset($id_user)) {
                $nb_messages = $request->input('nb_messages');
                $user = User::find($id_user);
                $id_conv = $request->input('id_conv');
                $messages = $user->getMessagesInConv($nb_messages,$id_conv);
                echo json_encode($messages);
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



    public function getPendingFriendships(Request $request)
    {
        app('debugbar')->disable();
        if (config('custom_settings.token_mobile') == $request->input('token_mobile')) {
            $user_id = $request->input('id_user');
            if (isset($user_id)) {                
                $user = User::find($user_id);
                $pending =  $user->getFriendRequests();
                echo json_encode($pending);
            }
            else
            {
                return "failed";
            }
        }
        else
        {
            echo "refused";
        }
    }

    public function handleFriends(Request $request)
    {
        app('debugbar')->disable();
        if (config('custom_settings.token_mobile') == $request->input('token_mobile')) {
            $id_sender = $request->input('id_sender');
            $id_receiver = $request->input('id_receiver');
            if ((isset($id_user) && isset($id_receiver)) && ($id_receiver != $id_sender)) {
                $user_sender = User::find($id_sender);
                $user_receiver = User::find($id_receiver);
                $action = $request->input('id_receiver');
                switch ($action) {
                    case 'accept':
                        if ($user_sender->hasFriendRequestFrom($user_receiver)) {
                            $user_sender->acceptFriendRequest($user_receiver);
                            $conversation = new Conversation;
                            $conversation->users1_id = $user_sender->id;
                            $conversation->users2_id = $user_receiver->id;
                            $conversation->save();
                            return "success";
                        }
                        else
                        {
                            return "no_pending_friendship";
                        }
                        break;                        
                    case 'deny':
                        if ($user_sender->hasFriendRequestFrom($user_receiver)) {
                            $user_sender->denyFriendRequest($user_receiver);
                            return "success";
                        }
                        else
                        {
                            return "no_pending_friendship";
                        }
                        break;
                    case 'unblock':
                        if ($user_sender->hasFriendRequestFrom($user_receiver) || $user_sender->isFriendWith($user_receiver)) {
                            $user_sender->unblockFriend($user_receiver);
                            return "success";
                        }
                        else
                        {
                            return "no_pending_friendship";
                        }
                        break;
                    case 'block':
                        if ($user_sender->hasFriendRequestFrom($user_receiver) || $user_sender->isFriendWith($user_receiver)) {
                            $user_sender->blockFriend($user_receiver);
                            return "success";
                        }
                        else
                        {
                            return "no_pending_friendship";
                        }
                        break;
                    case 'ask':
                        if (!$user_sender->hasSentFriendRequestTo($user_receiver)) {
                            $user_sender->befriend($user_receiver);
                            return "success";
                        }
                        else
                        {
                            return "already_sent";
                        }
                        break;
                    default:
                        return "failed";
                        break;
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
}
