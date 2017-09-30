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
            'nom' => 'Dautry',
            'prenom' => 'Antoine',
            'ville' => 'Bouaye',
            'is_blocked' => 0,
            'verified' => 1,
            'email' => 'antoine.dautry@free.fr',
            'password' => bcrypt('p46993'),
            'date_inscription' => Carbon::now(),
            ]);

    }
}
