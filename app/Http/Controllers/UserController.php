<?php

namespace App\Http\Controllers;

use App\Models\CategorieClasse;
use App\Models\CategorieClasseProfesseur;
use App\Models\Classe;
use App\Models\Conversation;
use App\Models\Event;
use App\Models\Fichier;
use App\Models\Matiere;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Role;
use App\Models\EventUser;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\FriendshipNotification;
use App\Notifications\CourseNotification;
use Calendar;
use Carbon\Carbon;
use DB;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class UserController extends Controller
{
    /**
     * Gère la partie welcome (première connexion de l'utilisateur).
     * @param  Request $request   [description]
     * @param  integer $id        [description]
     * @param  [type]  $type      [description]
     * @param  [type]  $categorie [description]
     * @param  [type]  $classe    [description]
     * @return [type]             [description]
     */
    public function welcome(Request $request, $id = 1, $type = null, $categorie = null, $classe = null)
    {
        //Si l'id est dans les paramettres de l'url
        if (isset($id)) {
            $user = Auth::user();
            if (!$user->hasAnyRole()) {
                if ($id == 1) {
                    return view('users.welcome_1');
                } elseif ($id == 2) {
                    if ($type != null) {
                        if (in_array($type, array('teacher', 'student', 'parent'))) {
                            //Récupération des classes
                            $classes = DB::table('classes')
                                ->select('nom_categorie', 'nom_classe')
                                ->join('etats_validations', 'etats_validations.id', '=', 'classes.etats_validations_id')
                                ->join('categorie_classes', 'categorie_classes.id', '=', 'classes.categorie_classes_id')
                                ->where('nom_etat', 'validated')
                                ->orderBy('nom_categorie')
                                ->get();
                            $categories = DB::table('categorie_classes')
                                ->select('nom_categorie')
                                ->orderBy('nom_categorie')
                                ->get();

                            switch ($type) {
                                case 'teacher':
                                    $matieres = DB::table('matieres')
                                        ->select('nom_matiere')
                                        ->join('etats_validations', 'etats_validations.id', '=', 'matieres.etats_validations_id')
                                        ->where('nom_etat', 'validated')
                                        ->orderBy('nom_matiere')
                                        ->get();
                                    return view('users.welcome_2_teacher', ['classes' => $classes, 'categories' => $categories, 'matieres' => $matieres]);
                                case 'student':
                                    $categories = DB::table('categorie_classes')
                                        ->select('nom_categorie')
                                        ->orderBy('nom_categorie')
                                        ->get();

                                    return view('users.welcome_2_student', ['classes' => $classes, 'categories' => $categories]);
                                case 'parent':
                                    return view('users.welcome_2_parent');
                                default:
                                    # code...
                                    break;
                            }
                            return view('users.welcome_2');
                        } else {
                            Session::flash('bootstrap-alert-type', 'danger');
                            Session::flash('bootstrap-alert', trans('alerts.front.welcome_wrongchoice'));
                            return redirect()->route('user.welcome', ['id' => 1]);
                        }
                    } else {
                        Session::flash('bootstrap-alert-type', 'danger');
                        Session::flash('bootstrap-alert', trans('alerts.front.welcome_wrongchoice'));
                        return redirect()->route('user.welcome', ['id' => 1]);
                    }
                } else {
                    abort(404);
                }
            } else {
                return redirect()->route('user.dashboard');
            }
        } else {
            abort(404);
        }

    }

    public function getData()
    {
        if ($type != null) {
            $all       = urldecode(Input::get('classe'));
            $tab       = explode('$', $all);
            $tabLength = sizeof($tab);
            if ($tabLength != 2) {
                Session::flash('bootstrap-alert-type', 'danger');
                Session::flash('bootstrap-alert', trans('alerts.front.welcome_wrongchoice'));
                return redirect()->route('user.welcome', ['id' => 2, 'type' => $type]);
            } else {
                $classe    = $tab[1];
                $categorie = $tab[0];
                return redirect()->route('user.welcome', ['id' => 3, 'type' => $type, 'categorie' => $categorie, 'classe' => $classe]);
            }

        }
        //abort(404);
    }
    /**
     * Gère la partie finale de welcome (id = 3)
     * @param  Request $request [description]
     * @param  [type]  $type    Type de l'utilisateur (teacher, student ou parent)
     * @return [type]           [description]
     */
    public function welcomePost(Request $request, $type)
    {
        switch ($type) {
            case 'student':
                $data = Input::get('classe');
                if (count($data) > 0) {
                    $all       = urldecode(Input::get('classe'));
                    $tab       = explode('$', $all);
                    $tabLength = sizeof($tab);
                    if ($tabLength != 2) {
                        Session::flash('bootstrap-alert-type', 'danger');
                        Session::flash('bootstrap-alert', trans('alerts.front.welcome_wrongchoice'));
                        return redirect()->route('user.welcome', ['id' => 2, 'type' => $type]);
                    } else {
                        $classe    = $tab[1];
                        $categorie = $tab[0];
                        $role      = Role::where('name', (string) $type)->first();
                        $user      = Auth::user();
                        $user->attachRole($role);
                        return view('users.welcome_3', ['type' => $type]);
                    }
                } else {
                    Session::flash('bootstrap-alert-type', 'danger');
                    Session::flash('bootstrap-alert', trans('alerts.front.welcome_wrongchoice'));
                    return redirect()->route('user.welcome', ['id' => 2, 'type' => $type]);
                }
                break;

            case 'teacher':
                $matieres   = Input::get('matieres');
                $categories = Input::get('categories');

                if (count($categories) > 0 && count($matieres) > 0) {
                    $user = Auth::user();
                    foreach ($categories as $categorie) {
                        $categorie = CategorieClasse::where('nom_categorie', urldecode($categorie))->first();

                        foreach ($matieres as $matiere) {
                            $matiere = Matiere::where('nom_matiere', urldecode($matiere))->first();

                            $categorieClasseProfesseur                       = new CategorieClasseProfesseur;
                            $categorieClasseProfesseur->categorie_classes_id = $categorie->id;
                            $categorieClasseProfesseur->matieres_id          = $matiere->id;
                            $categorieClasseProfesseur->professeurs_id       = $user->id;
                            $categorieClasseProfesseur->save();
                        }
                    }

                    $role = Role::where('name', (string) $type)->first();
                    $user = Auth::user();
                    $user->attachRole($role);
                    return view('users.welcome_3', ['type' => $type]);
                } else {
                    Session::flash('bootstrap-alert-type', 'danger');
                    Session::flash('bootstrap-alert', trans('alerts.front.welcome_wrongchoice'));
                    return redirect()->route('user.welcome', ['id' => 2, 'type' => $type]);
                }
                break;
            default:
                Session::flash('bootstrap-alert-type', 'danger');
                Session::flash('bootstrap-alert', trans('alerts.front.welcome_wrongchoice'));
                return redirect()->route('user.welcome', ['id' => 2, 'type' => $type]);
                break;
        }

    }

    /**
     * user/inbox
     * @return [type] [description]
     */
    public function inbox($id_conv = null, $nb_message = 5)
    {
        $user          = Auth::user();
        $conversations = $user->getConversations();
        $nb_unread     = $user->getUnreadMessages();
        //On récupère la liste des demandes d'amitier
        $pending_friendships = $user->getFriendRequests();
        $pending_users_array = array();
        if (count($pending_friendships) > 0) {
            foreach ($pending_friendships as $pending_friendship) {
                $pending_user = User::find($pending_friendship->sender_id);
                array_push($pending_users_array, $pending_user);
            }
        }
        $conversations = $user->getConversationsWithFullnameAndUnread();
        if ($id_conv == null) {
            return view('users.inbox', ['conversations' => $conversations, 'nb_unread' => $nb_unread, 'conn_user' => $user, 'pending_friendships' => $pending_friendships, 'pending_users' => $pending_users_array, 'breadcrumb_title' => 'Messagerie']);
        } else {
            $conversation_exist = Conversation::find($id_conv);
            //On vérifie que la conversation avec l'id donné en paramètre existe
            if (count($conversation_exist) != 0) {
                //Si l'utilisateur connecté appartient à celle des conversations alors on peut l'afficher
                if ($user->canUserAccessToThisConv($id_conv)) {
                    //On marque les messages reçus en lu;
                    DB::table('messages')->where('conversations_id', $id_conv)
                        ->where('emmeteurs_id', '<>', $user->id)
                        ->update(['lu' => true]);

                    foreach ($conversations as $conversation) {
                        $conversation->nb_unread_conv = $user->getUnreadMessagesInConv($conversation->id);
                    }

                    $nb_unread      = $user->getUnreadMessages();
                    $nb_conv_unread = array();
                    //On récupère les messages
                    $messages = DB::select(DB::raw('SELECT nom_fichier, chemin, emmeteurs_id, fichiers_id, contenu, lu, CONCAT(users.prenom, " ", users.nom) as emmeteur, messages.created_at as heure_envoi FROM messages JOIN users on users.id = messages.emmeteurs_id LEFT JOIN fichiers ON messages.fichiers_id = fichiers.id WHERE conversations_id = ? ORDER BY messages.id DESC,messages.created_at DESC LIMIT ? '), [$id_conv, $nb_message]);
                    //On inverse les messages afin de pourvoir aficher les N derniers
                    $reverse = array_reverse($messages);

                    return view('users.conversation', ['conversations' => $conversations, 'nb_unread' => $nb_unread, 'conversations_id' => $id_conv, 'conn_user' => $user, 'messages' => $reverse, 'nb_messages' => $nb_message, 'pending_friendships' => $pending_friendships, 'pending_users' => $pending_users_array, 'breadcrumb_title' => 'Conversation']);

                } else {
                    abort(404);
                }
            } else {
                abort(404);
            }
        }

    }

    /**
     * Gestion de l'envoi de nouveaux messages
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function inboxPost(Request $request)
    {
        //On vérifie si le message n'est pas vide.
        $this->validate($request, [
            'contenu'          => 'required|max:255',
            'conversations_id' => 'required|regex:/^[0-9]+$/',
            'document'         => 'max:5000|file|mimes:jpeg,png,pdf,docx,xls',
        ]);

        $contenu = $request->input('contenu');
        $id_conv = $request->input('conversations_id');
        $user    = Auth::user();

        if ($request->hasFile('document')) {
            $file_tmp = $request->file('document');
            $name     = $file_tmp->getClientOriginalName();
            $path     = $file_tmp->store('public');
            $pathTab  = explode("/", $path);

            $fichier              = new Fichier;
            $fichier->nom_fichier = $name;
            $fichier->chemin      = $pathTab[1];
            $fichier->save();

            $message                   = new Message;
            $message->conversations_id = $id_conv;
            $message->emmeteurs_id     = $user->id;
            $message->contenu          = $contenu;
            $message->fichiers_id      = $fichier->id;
            $message->save();
        } else {
            $message                   = new Message;
            $message->conversations_id = $id_conv;
            $message->emmeteurs_id     = $user->id;
            $message->contenu          = $contenu;
            $message->save();
        }
        return redirect()->route('user.inbox', ['id' => $id_conv]);
    }

    /**
     * user/dashboard
     * @return [type] [description]
     */
    public function dashboard()
    {
        $user                = Auth::user();
        $pending_friendships = $user->getFriendRequests();
        $nb_unread           = $user->getUnreadMessages();
        $pending_users_array = array();
        if (count($pending_friendships) > 0) {
            foreach ($pending_friendships as $pending_friendship) {
                $pending_user            = User::find($pending_friendship->sender_id);
                $pending_user->sender_id = $pending_friendship->sender_id;
                array_push($pending_users_array, $pending_user);
            }
        }
        return view('users.dashboard', ['nb_unread' => $nb_unread, 'pending_friendships' => $pending_friendships, 'pending_users' => $pending_users_array, 'breadcrumb_title' => 'Accueil']);
    }

    public function addFriend(Request $request)
    {
        $email_recep = $request->input('email');
        if ($email_recep != null) {
            $recipient = User::where('email', '=', $email_recep)->first();
            if ($recipient != null) {
                $user = Auth::user();
                if ($user->id != $recipient->id) {
                    if ($user->hasSentFriendRequestTo($recipient)) {
                        Session::flash('bootstrap-alert-type', 'error');
                        Session::flash('bootstrap-alert', 'La demande de connexion a déjà été envoyée !');
                    }
                    else{
                        if($user->isFriendWith($recipient)){
                            Session::flash('bootstrap-alert-type', 'error');
                            Session::flash('bootstrap-alert', 'Vous êtes déjà amis avec cette personne !');
                        }
                        else{
                            $user->befriend($recipient);
                            Session::flash('bootstrap-alert-type', 'success');
                            Session::flash('bootstrap-alert', 'La demande de connexion a bien été envoyée !');
                        }
                    }
                } else {
                    Session::flash('bootstrap-alert-type', 'error');
                    Session::flash('bootstrap-alert', 'Vous ne pouvez pas vous ajouter vous même !');
                }

            } else {
                Session::flash('bootstrap-alert-type', 'warn');
                Session::flash('bootstrap-alert', "L'email que vous avez saisis ne correspond à aucun membre!");
            }
        } else {
            Session::flash('bootstrap-alert-type', 'danger');
            Session::flash('bootstrap-alert', 'Veuillez renseigner un email!');
        }
        return redirect()->back();
    }


    public function calendar(Request $request)
    {
        $events = [];
        $data   = Event::select('events.id','title','all_day', 'start_date', 'end_date', 'eventcategories_id', 'eventetats_id')
                        ->join('event_users', 'event_users.events_id', 'events.id')
                        ->where('users_id', Auth::id())
                        ->where('eventetats_id', '<>','5')->get(); //On n'affiche pas les évènements en attente
        if ($data->count()) {
            foreach ($data as $key => $value) {
                if ($value->eventetats_id != '1') {
                     if ($value->eventcategories_id == '1') {
                        $events[] = Calendar::event(
                            $value->title,
                            $value->all_day,
                            new \DateTime($value->start_date),
                            new \DateTime($value->end_date),
                            $value->id,
                            ['backgroundColor' => '#d9edf7', 'borderColor' => '#bce8f1', 'textColor' => '#31708f']
                        );
                    }
                    else
                    {
                        $events[] = Calendar::event(
                            $value->title,
                            $value->all_day,
                            new \DateTime($value->start_date),
                            new \DateTime($value->end_date),
                            $value->id,
                            ['backgroundColor' => '#dff0d8','borderColor' => '#d6e9c6', 'textColor' => '#3c763d']
                        );
                    }
                }
                else
                {
                    $events[] = Calendar::event(
                        $value->title,
                        $value->all_day,
                        new \DateTime($value->start_date),
                        new \DateTime($value->end_date),
                        $value->id,
                        ['backgroundColor' => '#f2dede', 'borderColor' => '#ebccd1', 'textColor' =>'#a94442']
                    );
                }
            }
        }
        $calendar = Calendar::addEvents($events);
        $calendar->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
            'eventDrop' => " function(event, delta, revertFunc,res) {

        if (!confirm('Êtes vous sure de vouloir déplacer cet évènement?')) {
            revertFunc();
        }
        else
        {
            console.log(event.end);
            var donnees = 'id_event='+ event.id +'&start_date='+ event.start.format('DD/MM/YYYY HH:mm') +'&end_date='+ event.end.format('DD/MM/YYYY HH:mm');
            console.log(donnees);
            $.ajax({
              url: '" .@route('user.mooveEvent') ."',
              data: donnees,
              type: 'POST',
              success: function(data_response) {
                if (data_response === 'success') {
                    console.log('OK');
                }
                else
                {
                    console.log(data_response);
                    console.log('KO');
                    revertFunc();
                }
              },
              error: function(xhr, status, error) {
                console.log(xhr.responseText);
                },
            });
        }

    }",
        ]);
        $user                = Auth::user();
        $pending_friendships = $user->getFriendRequests();
        $nb_unread           = $user->getUnreadMessages();
        $pending_users_array = array();
        if (count($pending_friendships) > 0) {
            foreach ($pending_friendships as $pending_friendship) {
                $pending_user            = User::find($pending_friendship->sender_id);
                $pending_user->sender_id = $pending_friendship->sender_id;
                array_push($pending_users_array, $pending_user);
            }
        }

        return view('users.calendar', ['calendar' => $calendar, 'nb_unread' => $nb_unread, 'pending_friendships' => $pending_friendships, 'pending_users' => $pending_users_array, 'breadcrumb_title' => 'Calendrier']);
    }

    public function askClass(Request $request)
    {
        $user                = Auth::user();
        $pending_friendships = $user->getFriendRequests();
        $nb_unread           = $user->getUnreadMessages();
        $pending_users_array = array();
        if (count($pending_friendships) > 0) {
            foreach ($pending_friendships as $pending_friendship) {
                $pending_user            = User::find($pending_friendship->sender_id);
                $pending_user->sender_id = $pending_friendship->sender_id;
                array_push($pending_users_array, $pending_user);
            }
        }

        $friendships = $user->getAcceptedFriendships();
        $teachers = array();
        foreach ($friendships as $friendship) {
            $friend = null;
            if ($friendship->recipient_id == Auth::id()) {
                $friend = User::find($friendship->sender_id);
            }
            else
            {
                $friend = User::find($friendship->recipient_id);
            }

            if ($friend->hasRole('teacher') && ($friend->id != $user->id)) {
                $teacher['id'] = $friend->id;
                $teacher['name'] = $friend->prenom . ' ' . $friend->nom;
                array_push($teachers, $teacher);
            }
        }
        return view('users.askclass', ['nb_unread' => $nb_unread, 'pending_friendships' => $pending_friendships, 'pending_users' => $pending_users_array, 'breadcrumb_title' => 'Demande de cours', 'teachers' => $teachers]);
    }

    public function profile(Request $request)
    {
         $user                = Auth::user();
        $pending_friendships = $user->getFriendRequests();
        $nb_unread           = $user->getUnreadMessages();
        $pending_users_array = array();
        if (count($pending_friendships) > 0) {
            foreach ($pending_friendships as $pending_friendship) {
                $pending_user            = User::find($pending_friendship->sender_id);
                $pending_user->sender_id = $pending_friendship->sender_id;
                array_push($pending_users_array, $pending_user);
            }
        }

        $friendships = $user->getAcceptedFriendships();
         return view('users.profile', ['nb_unread' => $nb_unread, 'pending_friendships' => $pending_friendships, 'pending_users' => $pending_users_array, 'breadcrumb_title' => 'Mon profil']);
    }
    

    /*=====================================
    =            FONCTION POST            =
    =====================================*/
    public function readNotification(Request $request)
    {
        $notifications_id = $request->input('notifications_id');
        if (isset($notifications_id)) {
            $notification = Notification::find($notifications_id);

            if (isset($notification)) {
                $notification->read_at = Carbon::now();
                $notification->save();
                return "success";
            } else {
                return "failed";
            }
        } else {
            return "failed";
        }
    }
    
    

    public function handleFriends(Request $request)
    {
        $id_senders  = $request->input('id_senders');
        $id_receiver = $request->input('id_receiver');

        // 2 : demande refusée
        // 1 : demande acceptée
        // 3 : bloquer l'utilisateur
        $action = $request->input('action');
        $return_value;
        app('debugbar')->disable();
        if (isset($id_senders) && isset($id_receiver) && isset($action)) {
            $user   = User::find($id_receiver);
            $sender = User::find($id_senders);
            if ($user->hasFriendRequestFrom($sender)) {
                if ($action == 2) {
                    $user->denyFriendRequest($sender);
                } else if ($action == 1) {
                    $user->acceptFriendRequest($sender);
                    $conversation            = new Conversation;
                    $conversation->users1_id = $user->id;
                    $conversation->users2_id = $sender->id;
                    $conversation->save();
                } else if ($action == 3) {
                    $user->blockFriend($sender);
                }
                $return_value = "success";
            } else {
                $return_value = "no_pending_request";
            }
            $sender->notify(new FriendshipNotification($action, $user->prenom . ' ' . $user->nom));
        } else {
            $return_value = "error";
        }

        return $return_value;
    }

    public function mooveEvent(Request $request)
    {
        app('debugbar')->disable();
        $id_event = $request->input('id_event');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        if (isset($id_event) && isset($start_date) && isset($end_date)) {
            $new_start =  \DateTime::createFromFormat('d/m/Y H:i', $start_date);
            $new_end =  \DateTime::createFromFormat('d/m/Y H:i', $end_date);

            $event = Event::find($id_event);

            if (isset($event)) {
                $event->start_date = $new_start;
                $event->end_date = $new_end;
                $event->save();
                return "success";
            }
            else
            {
                return "failed";
            }
        }
        else
        {
            return "failed1";
        }
    }

    public function askClassPost(Request $request)
    {
        //On vérifie si le formulaire est bien rempli n'est pas vide.
        $this->validate($request, [
            'title'      => 'required|max:255',
            'date'       => 'required',
            'duration'   => 'required|max:3|min:1',
            'professeur' => 'required',
        ]);

        $title = $request->input('title');
        $start_date = new \DateTime($request->input('date'));
        $duration = $request->input('duration');
        $end_date = clone $start_date;
        $end_date->add(new DateInterval('PT' . $duration . 'M'));        
        $professeur = $request->input('professeur');

        $recipient = User::find($professeur);
        if (isset($recipient)) {  
            $event = new Event;
            $event->title = $title;
            $event->start_date = $start_date;
            $event->end_date = $end_date;
            $event->eventcategories_id = 2; // Cours
            $event->eventetats_id = 5; // Pending
            $event->save();


            $event_user_creator = new EventUser;
            $event_user_creator->users_id = Auth::id();
            $event_user_creator->events_id = $event->id;
            $event_user_creator->creator = 1;
            $event_user_creator->save();

            $event_user_reciever = new EventUser;
            $event_user_reciever->users_id = $professeur;
            $event_user_reciever->events_id = $event->id;
            $event_user_reciever->save();

            
            flash()->success('L\'évènement a été créé !');
            $recipient->notify( new CourseNotification($event, Auth::user(),'ask'));
            return redirect()->route('user.askClass');
        }
        else
        {
            flash()->error('Le professeur saisis n\'existe pas!');
            return view('users.askclass');
        }
    }

    public function handleClass(Request $request)
    {
        app('debugbar')->disable();
        $id_event = $request->input('id_event');
        $id_notification = $request->input('id_notification');
        $senders_id = $request->input('senders_id');
        $action = $request->input('action');
        $notification = Notification::find($id_notification);
        $event = Event::find($id_event);
        if(empty($event) && empty($notification) && !isset($action))
        {
            return "empty_parameter";
        }
        else
        {
            switch ($action) {
                case '0':
                    $notification->read_at = Carbon::now();
                    $notification->save();
                    $event->eventetats_id = 6; // Refusé
                    $recipient = User::find($senders_id);
                    $recipient->notify( new CourseNotification($event, Auth::user(),'reply', 0));
                    $event->save();
                    return "success";
                    break;
                case '1':
                    $notification->read_at = Carbon::now();
                    $notification->save();
                    $event->eventetats_id = 4; // Planifié
                    $event->save();
                    $recipient = User::find($senders_id);
                    $recipient->notify( new CourseNotification($event, Auth::user(),'reply', 1));
                    return "success";
                    break;
                default:
                    return "wrong_action";
                    break;
            }
        }
    }

    public function changePassword(Request$request)
    {
        $u = Auth::user();
        if (isset($u)) {
            $password_old = $request->input('old_password');
            $password_new = $request->input('password');
            if (strlen($password_new) >= 6) {
                if (Hash::check($password_old, $u->password)) {
                    $u->password = bcrypt($password_new);
                    $u->save();
                    flash()->success('Le mot de passe a bien été mis à jours.');
                    return redirect()->route('user.profile');                
                }
                else{
                    //Le old_password ne match pas avec celui dans la BDD
                    flash()->error('L\'ancien mot de passe n\'est pas correct.');
                    return redirect()->route('user.profile');                ;
                }
            }
            else
            {
                //Mdp inférieur à 6 char
                //Le old_password ne match pas avec celui dans la BDD
                flash()->error('La taille du mot de passe n\'est pas correct.');
                return redirect()->route('user.profile');                ;
            }
        }
        else
        {
            //Utilisateur non trouvé
            //Le old_password ne match pas avec celui dans la BDD
            flash()->error('Utilisateur non trouvé.');
            return redirect()->route('user.profile');                ;
        }
    }



    /*=====  End of FONCTION POST  ======*/
    
}
