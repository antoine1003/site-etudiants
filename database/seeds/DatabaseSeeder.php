<?php

use Illuminate\Database\Seeder;
use App\Models\Classe;
use App\Models\EtatsValidation;
use App\Models\CategorieClasse;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EtatValidationSeeder::class);
        $this->call(CategorieClasseSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ClasseSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
