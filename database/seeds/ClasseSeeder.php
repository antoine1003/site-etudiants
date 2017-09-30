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
        for($i = 0; $i < 20; $i++) {
        Classe::create([
            'nom_classe' => 'classe '.$i,
            'etats_validations_id' => rand (1 , 3),
            'categorie_classes_id' => rand (1 , 4),
            ]);           
        }
    }
}
