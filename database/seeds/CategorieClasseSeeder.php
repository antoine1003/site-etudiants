<?php

use Illuminate\Database\Seeder;
use App\Models\CategorieClasse;

class CategorieClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategorieClasse::create([
            'id' => 1,
            'nom_categorie' => 'bts',
        ]);

         CategorieClasse::create([
            'id' => 2,
            'nom_categorie' => 'collège',
        ]);

         CategorieClasse::create([
            'id' => 3,
            'nom_categorie' => 'lycée',
        ]);
         CategorieClasse::create([
            'id' => 4,
            'nom_categorie' => 'école d\'ingénieur',
        ]);
         CategorieClasse::create([
            'id' => 5,
            'nom_categorie' => 'classe préparatoire',
        ]);
          CategorieClasse::create([
            'id' => 6,
            'nom_categorie' => 'autre',
        ]);
    }
}
