<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Hash;

class MobileController extends Controller
{
    /*=======================================
    =            FONCTIONS USERS            =
    =======================================*/
    /**
     * Retourne tous les utilisateurs
     * @return User [description]
     */
    public function getAllUsers()
    {
        app('debugbar')->disable();
        $users = User::all();
        return json_encode($users);
    }

    /**
     * Retourne l'utilisateur ayant l'id donné en paramètre.
     * @param  Request $request [description]
     * @return User           [description]
     */
    public function getUserInfoById(Request $request)
    {
        app('debugbar')->disable();
        $id = $request->input('user_id');
        $token = $request->input('token_mobile');
        if (config('custom_settings.token_mobile') == $token) {
            $user = User::find($id);
            if (empty($user)) {
                return "failed";
            }
            else
            {
                return '['.json_encode($user).']';
            }
            
        }
        else
        {
            return "refused";
        }
    }

    /**
     * Retourne l'utilisateur ayant l'email donné en paramètre.
     * @param  Request $request [description]
     * @return User           [description]
     */
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
                return "failed";
            }
            else
            {
                return '['.json_encode($user).']';
            }
        }
        else
        {
            return "refused";
        }
    }

    /**
     * Fonction permettant de gérer le changement du mot de passe de l'utilisateur.
     * @param  Request $request [description]
     * @return string           [description]
     */
    public function passwordUpdate(Request $request)
    {
        app('debugbar')->disable();
        if (config('custom_settings.token_mobile') == $request->input('token_mobile')) {
            $u = User::where('id', $request->input('id_user'))->first();
            if (isset($u)) {
                $password_old = $request->input('password_old');
                $password_new = $request->input('password_new');
                if (strlen($password_new) >= 6) {
                    if (Hash::check($request->input('password_old'), $u->password)) {
                        $u->password = bcrypt($password_new);
                        $u->save();
                        return "success";                
                    }
                    else{
                        //Le old_password ne match pas avec celui dans la BDD
                        return "failed";
                    }
                }
                else
                {
                    //Mdp inférieur à 6 char
                    return "wrong_size";
                }
                
            }
            else
            {
                //Utilisateur non trouvé
                return "failed";
            }
         }
        else
        {
            //Token mismatch
            return "refused";
        }
    }
    
    
    /*=====  End of FONCTIONS USERS  ======*/



    
   /*==========================================================
   =            FONCTIONS CONVERSATIONS / MESSAGES            =
   ==========================================================*/
   
   /**
    * Renvois la liste des conversations concernant l'utilisateur donné en variable POST (id_user).
    * @param  Request $request [description]
    * @return Conversation           [description]
    */
    public function getConversationsWithFullname(Request $request)
    {
        app('debugbar')->disable();
        $id = $request->input('id_user');
        $token = $request->input('token_mobile');
        if (config('custom_settings.token_mobile') == $token) {            
            $user = User::find($id);
            if ($user != null) {                
                $conversations = $user->getConversationsWithFullnameAndUnread();
                return json_encode($conversations);
            }
            else
            {
                return "failed";
            }
        }
        else
        {
            return "refused";
        }
    }

    /**
     * Ajout d'un message dans une conversation donnée en variable POST.
     * @param Request $request [description]
     * @return  string 
     */
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
                return "success";
            }
            else
            {
                return "failed";
            }
           
        }
        else
        {
            return "refused";
        }
    }
    
    /**
     * Retourne les messages formatés pour un utilisateur et une conversation.
     * @param  Request $request [description]
     * @return string|Message           [description]
     */
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
                return json_encode($messages);
            }
            else
            {
                return "failed";
            }           
        }
        else
        {
            return "refused";
        }
    }
   
   
   /*=====  End of FONCTIONS CONVERSATION / MESSAGES  ======*/
   
   /*==================================
   =            CONNECTION            =
   ==================================*/
   
   /**
    * Gère la connexion de l'utilisateur
    * @param  Request $request [description]
    * @return string           [description]
    */
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
                            return "blocked";
                        }
                        else
                        {
                            return "success";
                        }
                    }
                    else
                    {
                        return "unverified";
                    }
                   
                }
                else
                {
                    return "failed";
                }
            }
            else{
                return "failed";
            }
        }
        else
        {
            return "refused";
        }
    }
   
   /*=====  End of CONNECTION  ======*/
   
   

    /*==================================
    =            FRIENDSHIP            =
    ==================================*/
    
    /**
     * Retourne la liste des demandes d'amitier reçues.
     * Le status vaut forcément 0.
     * @param  Request $request   [description]
     * @return Friendship|string  [description]
     */
    public function getPendingFriendships(Request $request)
    {
        app('debugbar')->disable();
        if (config('custom_settings.token_mobile') == $request->input('token_mobile')) {
            $id_recipient = $request->input('id_recipient');
            if (isset($id_recipient)) {                
                $recipient = User::find($id_recipient);
                if (isset($recipient)) {
                    $pending =  $recipient->getFriendRequests();
                    if (sizeof($pending) > 0) {
                        return json_encode($pending);
                    }
                    else{                        
                        return "no_pending_friendship";
                    }
                }
                else
                {
                    return "user_not_found";
                }
            }
            else
            {
                return "failed";
            }
        }
        else
        {
            return "refused";
        }
    }


    /**
     * Gestion des demande d'amis. Permet d'accepter, refuser, bloquer ou débloquer une demande.
     * @param  Request $request [description]
     * @return string           [description]
     */
    public function handleFriends(Request $request)
    {
        app('debugbar')->disable();
        if (config('custom_settings.token_mobile') == $request->input('token_mobile')) {
            $id_sender = $request->input('id_sender');
            $id_receiver = $request->input('id_receiver');
            if ((isset($id_sender) && isset($id_receiver)) && ($id_receiver != $id_sender)) {
                $user_sender = User::find($id_sender);
                $user_receiver = User::find($id_receiver);
                /**
                 * Action a effectué sur la demande :
                 * - accept
                 * - deny
                 * - unblock
                 * - block
                 * @var string
                 */
                $action = $request->input('action');
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
                return "failed";
            }           
        }
        else
        {
            return "refused";
        }
    }
    
    
    /*=====  End of FRIENDSHIP  ======*/
    
   



  
}
