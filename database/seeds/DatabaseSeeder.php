<?php

use Illuminate\Database\Seeder;
use App\Models\Classe;
use App\Models\EtatsValidation;
use App\Models\CategorieClasse;
use App\Models\User;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ETAT VALIDATION
    	 EtatsValidation::create([
    	 	'id' => 1,
            'nom_etat' => 'validated',
        ]);
    	 EtatsValidation::create([
    	 	'id' => 2,
            'nom_etat' => 'pending',
        ]);
    	 EtatsValidation::create([
    	 	'id' => 3,
            'nom_etat' => 'rejected',
        ]);

         // CATEGORIE CLASSE
         CategorieClasse::create([
            'id' => 1,
            'nom_categorie' => 'BTS',
        ]);

         CategorieClasse::create([
            'id' => 2,
            'nom_categorie' => 'Collège',
        ]);

         CategorieClasse::create([
            'id' => 3,
            'nom_categorie' => 'Lycée',
        ]);
         CategorieClasse::create([
            'id' => 4,
            'nom_categorie' => 'Ecole d\'ingénieur',
        ]);
          CategorieClasse::create([
            'id' => 5,
            'nom_categorie' => 'Autre',
        ]);

         //CLASSE

        for($i = 0; $i < 20; $i++) {
        Classe::create([
            'nom_classe' => 'Classe '.$i,
            'etats_validations_id' => rand (1 , 3),
            'categorie_classes_id' => rand (1 , 4),
            ]);           
        }

        // USER
        User::create([
            'nom' => 'Dautry',
            'prenom' => 'Antoine',
            'ville' => 'Bouaye',
            'is_blocked' => 0,
            'verified' => 1,
            'email' => 'antoine.dautry@free.fr',
            'password' => bcrypt('p46993'),
            'date_inscription' => Carbon::now(),
            ]);
    }
}
