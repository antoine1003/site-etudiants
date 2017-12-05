<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Classe;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\CategorieClasseProfesseur;
use App\Models\Matiere;
use App\Models\CategorieClasse;
use DB;

class UserController extends Controller
{
    public function welcome(Request $request, $id = 1, $type = null, $categorie = null,  $classe = null)
    {
        //Si l'id est dans les paramettres de l'url
    	if (isset($id)) 
        {
            $user = Auth::user();
            if (!$user->hasAnyRole()) 
            {
                if ($id == 1) 
                {
                    return view('users.welcome_1');
                }
                elseif ($id == 2) 
                {
                    if ($type != null) 
                    {
                        if(in_array($type, array('teacher','student','parent' )))
                        {
                            //Récupération des classes
                            $classes = DB::table('classes')
                                ->select('nom_categorie','nom_classe')
                                ->join('etats_validations', 'etats_validations.id', '=', 'classes.etats_validations_id')
                                ->join('categorie_classes','categorie_classes.id','=','classes.categorie_classes_id')
                                ->where('nom_etat', 'validated')
                                ->orderBy('nom_categorie')
                                ->get();
                            $categories = DB::table('categorie_classes')
                                ->select('nom_categorie')
                                ->orderBy('nom_categorie')
                                ->get();

                            switch ($type) 
                            {
                                case 'teacher':
                                    $matieres = DB::table('matieres')
                                        ->select('nom_matiere')                                        
                                        ->join('etats_validations', 'etats_validations.id', '=', 'matieres.etats_validations_id')
                                        ->where('nom_etat', 'validated')
                                        ->orderBy('nom_matiere')
                                        ->get();
                                    return view('users.welcome_2_teacher',['classes' => $classes, 'categories' => $categories, 'matieres' => $matieres]);
                                case 'student':
                                    $categories = DB::table('categorie_classes')
                                    ->select('nom_categorie')
                                    ->orderBy('nom_categorie')
                                    ->get();

                                    return view('users.welcome_2_student',['classes' => $classes, 'categories' => $categories]);
                                case 'parent':
                                    return view('users.welcome_2_parent');
                                default:
                                    # code...
                                    break;
                            }
                            return view('users.welcome_2');
                        }
                        else
                        {
                            Session::flash('bootstrap-alert-type', 'danger');
                            Session::flash('bootstrap-alert', trans('alerts.front.welcome_wrongchoice'));
                            return redirect()->route('user.welcome',['id' => 1]);
                        }
                    }
                    else
                    {                        
                        Session::flash('bootstrap-alert-type', 'danger');
                        Session::flash('bootstrap-alert', trans('alerts.front.welcome_wrongchoice'));
                        return redirect()->route('user.welcome',['id' => 1]);
                    }
                }
                else
                {
                    abort(404);
                }
            }
            else
            {
                return redirect()->route('user.dashboard');
            }  
		}
        else
        {
            abort(404);
        }
    	
    }


    public function getData()
    {
        if ($type != null) {
            $all  = urldecode(Input::get('classe'));
            $tab = explode('$', $all);
            $tabLength = sizeof($tab);
            if ($tabLength != 2) {
                Session::flash('bootstrap-alert-type', 'danger');
                Session::flash('bootstrap-alert', trans('alerts.front.welcome_wrongchoice'));
                return redirect()->route('user.welcome',['id' => 2, 'type' => $type]);
            }
            else{
                $classe = $tab[1];
                $categorie = $tab[0];
                return redirect()->route('user.welcome',['id' => 3,'type' => $type,'categorie' => $categorie, 'classe' => $classe]);
            }
            
        }
        //abort(404);
    }
    /**
     * Gère la partie finale de welcome (id = 3)
     * @param  Request $request [description]
     * @param  [type]  $type    [description]
     * @return [type]           [description]
     */
    public function welcomePost(Request $request, $type)
    {
        switch ($type) {
            case 'student':
                $data = Input::get('classe');
                if (count($data) > 0 ){
                    $all  = urldecode(Input::get('classe'));
                    $tab = explode('$', $all);
                    $tabLength = sizeof($tab);
                    if ($tabLength != 2) {
                        Session::flash('bootstrap-alert-type', 'danger');
                        Session::flash('bootstrap-alert', trans('alerts.front.welcome_wrongchoice'));
                        return redirect()->route('user.welcome',['id' => 2, 'type' => $type]);
                    }
                    else{
                        $classe = $tab[1];
                        $categorie = $tab[0];
                        $role = Role::where('name',(string)$type)->first();
                        $user = Auth::user();
                        $user->attachRole($role);
                        return view('users.welcome_3',['type' => $type]);
                    }
                }
                else
                {
                    Session::flash('bootstrap-alert-type', 'danger');
                    Session::flash('bootstrap-alert', trans('alerts.front.welcome_wrongchoice'));
                    return redirect()->route('user.welcome',['id' => 2, 'type' => $type]);
                }
                break;

            case 'teacher':
                $matieres = Input::get('matieres');
                $categories = Input::get('categories');

                if (count($categories) > 0 && count($matieres) > 0 )
                {
                    $user = Auth::user();
                    foreach ($categories as $categorie){
                        $categorie = CategorieClasse::where('nom_categorie', urldecode($categorie))->first();

                        foreach ($matieres as $matiere) {
                            $matiere = Matiere::where('nom_matiere', urldecode($matiere))->first();

                            $categorieClasseProfesseur = new CategorieClasseProfesseur;
                            $categorieClasseProfesseur->categorie_classes_id = $categorie->id;                            
                            $categorieClasseProfesseur->matieres_id = $matiere->id;
                            $categorieClasseProfesseur->professeurs_id = $user->id;
                            $categorieClasseProfesseur->save();
                        }
                    }

                    $role = Role::where('name',(string)$type)->first();
                    $user = Auth::user();
                    $user->attachRole($role);
                     return view('users.welcome_3',['type' => $type]);
                }
                else
                {
                    Session::flash('bootstrap-alert-type', 'danger');
                    Session::flash('bootstrap-alert', trans('alerts.front.welcome_wrongchoice'));
                    return redirect()->route('user.welcome',['id' => 2, 'type' => $type]);
                }
                break;
            default:
                Session::flash('bootstrap-alert-type', 'danger');
                Session::flash('bootstrap-alert', trans('alerts.front.welcome_wrongchoice'));
                return redirect()->route('user.welcome',['id' => 2, 'type' => $type]);
                break;
        }
        
    }

    public function dashboard()
    {
        $user = Auth::user();
        $nb_unread = $user->getUnreadMessages();
        return view('users.dashboard',['nb_unread'=> $nb_unread]);
    }
}
