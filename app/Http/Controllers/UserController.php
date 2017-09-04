<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Classe;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use DB;

class UserController extends Controller
{
    
    
    public function welcome(Request $request, $id = 1, $type = null, $categorie = null,  $classe = null)
    {
        //Si l'id est dans les paramettres de l'url
    	if (isset($id)) {
    		if ($id == 1) {
    			return view('users.welcome_1');
    		}

    		elseif ($id == 2) {
    			if ($type != null) {
    				if(in_array($type, array('teacher','student','parent' )))
    				{

                        switch ($type) {
                            case 'teacher':
                                return view('users.welcome_2_teacher');
                            case 'student':

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

    			Session::flash('bootstrap-alert-type', 'danger');
    			Session::flash('bootstrap-alert', trans('alerts.front.welcome_wrongchoice'));
    			return redirect()->route('user.welcome',['id' => 1]);
    		}elseif ($id == 3) {
    			return view('users.welcome_3');
    		}
    		
    		
    	}
    	abort(404);
    }

    public function welcomeGetDisplay(Request $request,$type)
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
}
