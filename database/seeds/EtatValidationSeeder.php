<?php

use Illuminate\Database\Seeder;
use App\Models\EtatsValidation;

class EtatValidationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
