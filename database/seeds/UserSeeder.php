<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create('fr_FR');
        for ($i=1; $i < 15; $i++) { 
            User::create([
            'id' => $i,
            'nom' => $faker->lastName,
            'prenom' => $faker->firstName,
            'ville' => $faker->city,
            'is_blocked' => 0,
            'verified' => 1,
            'phone' => $faker->phoneNumber,
            'email' => 'adresse'. $i .'@mail.fr',
            'password' => bcrypt('password'),
            'date_inscription' => Carbon::now(),
            ]);
        }
    }
}
