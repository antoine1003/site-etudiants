<?php

use Illuminate\Database\Seeder;
use App\Models\Matiere;

class MatiereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Matiere::create([
            'nom_matiere' => 'Mathématiques',
            'etats_validations_id' => '1',
        ]);

        Matiere::create([
            'nom_matiere' => 'Informatique',
            'etats_validations_id' => '1',
        ]);

        Matiere::create([
            'nom_matiere' => 'Physiques',
            'etats_validations_id' => '1',
        ]);   

        Matiere::create([
            'nom_matiere' => 'Français',
            'etats_validations_id' => '1',
        ]);

        Matiere::create([
            'nom_matiere' => 'Anglais',
            'etats_validations_id' => '1',
        ]); 

        Matiere::create([
            'nom_matiere' => 'Espagnol',
            'etats_validations_id' => '1',
        ]);

        Matiere::create([
            'nom_matiere' => 'Histoire',
            'etats_validations_id' => '1',
        ]);

        Matiere::create([
            'nom_matiere' => 'Géographie',
            'etats_validations_id' => '1',
        ]);

        Matiere::create([
            'nom_matiere' => 'Phylosophie',
            'etats_validations_id' => '1',
        ]);

        Matiere::create([
            'nom_matiere' => 'SVT',
            'etats_validations_id' => '1',
        ]);

        Matiere::create([
            'nom_matiere' => 'Droit',
            'etats_validations_id' => '1',
        ]);

        Matiere::create([
            'nom_matiere' => 'Management',
            'etats_validations_id' => '1',
        ]); 
    }
}
