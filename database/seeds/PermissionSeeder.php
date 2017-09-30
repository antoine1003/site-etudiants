<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
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
    }
}
