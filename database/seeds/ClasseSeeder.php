<?php

use Illuminate\Database\Seeder;
use App\Models\Classe;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Classe::create([
            'nom_classe' => 'BTS SN opt IR',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 1,
            ]);

        Classe::create([
            'nom_classe' => 'BTS SIO',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 1,
            ]);

        Classe::create([
            'nom_classe' => 'BTS SN opt IJ',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 1,
            ]);
        Classe::create([
            'nom_classe' => '6ème',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 2,
            ]);
        Classe::create([
            'nom_classe' => '5ème',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 2,
            ]);
        Classe::create([
            'nom_classe' => '4ème',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 2,
            ]);
        Classe::create([
            'nom_classe' => '3ème',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 2,
            ]);
        Classe::create([
            'nom_classe' => '2nd Générale',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 3,
            ]);
        Classe::create([
            'nom_classe' => '1èreES',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 3,
            ]);
        Classe::create([
            'nom_classe' => '1èreS',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 3,
            ]);
        Classe::create([
            'nom_classe' => '1èreL',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 3,
            ]);
        Classe::create([
            'nom_classe' => 'TermES',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 3,
            ]);
        Classe::create([
            'nom_classe' => 'TermS',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 3,
            ]);
        Classe::create([
            'nom_classe' => 'TermL',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 3,
            ]);
        Classe::create([
            'nom_classe' => 'Informatique',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 4,
        ]);
        Classe::create([
            'nom_classe' => 'Mécanique',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 4,
        ]);
        Classe::create([
            'nom_classe' => 'Physique',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 4,
        ]);
        Classe::create([
            'nom_classe' => 'Management',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 4,
        ]);
        Classe::create([
            'nom_classe' => 'MPSI',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 5,
        ]);
        Classe::create([
            'nom_classe' => 'PCSI',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 5,
        ]);
        Classe::create([
            'nom_classe' => 'TSI',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 5,
        ]);
        Classe::create([
            'nom_classe' => 'MP',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 5,
        ]);
        Classe::create([
            'nom_classe' => 'PSI',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 5,
        ]);
        Classe::create([
            'nom_classe' => 'PC',
            'etats_validations_id' => 1,
            'categorie_classes_id' => 5,
        ]);
    }
}
