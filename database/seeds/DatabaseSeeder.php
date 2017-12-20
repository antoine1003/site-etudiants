<?php

use Illuminate\Database\Seeder;
use App\Models\Classe;
use App\Models\EtatsValidation;
use App\Models\EventCategorie;
use App\Models\CategorieClasse;
use App\Models\User;
use App\Models\Matiere;
use App\Models\EventEtat;
use App\Models\Conversation;
use App\Models\Event;
use App\Models\EventUser;

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
        $this->call(MatiereSeeder::class);
        $this->call(BlockedUserSeeder::class);
        //$this->call(ConversationSeeder::class);
        //$this->call(MessageSeeder::class);
        $this->call(EventCategorieSeeder::class);
        $this->call(EventEtatSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(EventUserSeeder::class);
    }
}
