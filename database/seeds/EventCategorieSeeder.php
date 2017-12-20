<?php

use Illuminate\Database\Seeder;
use App\Models\EventCategorie;

class EventCategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventCategorie::create([
            'id' => 1,
        	'nom_categorie' => 'Devoirs'
        ]);

        EventCategorie::create([
            'id' => 2,
        	'nom_categorie' => 'Cours'
        ]);
    }
}
