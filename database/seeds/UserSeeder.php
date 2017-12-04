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
        // USER
        User::create([
            'id' => 1,
            'nom' => 'Dautry',
            'prenom' => 'Antoine',
            'ville' => 'Bouaye, France',
            'is_blocked' => 0,
            'verified' => 1,
            'email' => 'antoine.dautry@free.fr',
            'password' => bcrypt('p46993'),
            'date_inscription' => Carbon::now(),
            ]);

        // USER
        User::create([
            'id' => 2,
            'nom' => 'Jaffrennou',
            'prenom' => 'Arnaud',
            'ville' => 'Bouguenais, France',
            'is_blocked' => 0,
            'verified' => 0,
            'email' => 'arnaud@mail.fr',
            'password' => bcrypt('password'),
            'date_inscription' => Carbon::now(),
            ]);

         // USER
        User::create([
            'id' => 3,
            'nom' => 'Molinaro',
            'prenom' => 'Antoine',
            'ville' => 'Nantes, France',
            'is_blocked' => 1,
            'verified' => 1,
            'email' => 'antoine@mail.fr',
            'password' => bcrypt('password'),
            'date_inscription' => Carbon::now(),
            ]);

    }
}
