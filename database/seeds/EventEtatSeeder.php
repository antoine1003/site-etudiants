<?php

use App\Models\EventEtat;
use Illuminate\Database\Seeder;

class EventEtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventEtat::create([
            'id'              => 1,
            'nom_etat_public' => 'Annulé',
            'nom_etat'        => 'canceled',
        ]);

        EventEtat::create([
            'id' => 2,
            'nom_etat_public' => 'Déplacé',
            'nom_etat'        => 'mooved',
        ]);

        EventEtat::create([
            'id'              => 3,
            'nom_etat_public' => 'Terminé',
            'nom_etat'        => 'done',
        ]);

        EventEtat::create([
            'id'              => 4,
            'nom_etat_public' => 'Planifié',
            'nom_etat'        => 'planned',
        ]);

        EventEtat::create([
            'id'              => 5,
            'nom_etat_public' => 'En attente',
            'nom_etat'        => 'pending',
        ]);

        EventEtat::create([
            'id'              => 6,
            'nom_etat_public' => 'Refusé',
            'nom_etat'        => 'refused',
        ]);
    }
}
