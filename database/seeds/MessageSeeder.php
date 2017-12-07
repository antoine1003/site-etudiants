<?php

use Illuminate\Database\Seeder;
use App\Models\Message;
use Carbon\Carbon;
class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/**
    	 * 1 : dautry
    	 * 2 : arnaud
    	 * 3 : moli 
    	 */
    	Message::create([
    		'emmeteurs_id' => 1,
            'conversations_id' => 1,
            'contenu' => 'Bonjour Arnaud, Tu vas bien?',
        ]);

    	Message::create([
    		'emmeteurs_id' => 2,
    		'conversations_id' => 1,
    		'contenu' => 'Super et toi?',
    	]);

    	Message::create([
    		'emmeteurs_id' => 1,
            'conversations_id' => 2,
            'contenu' => 'Ou se trouve l\'oiseau? Oui, non, zbradaraldjan?' ,
        ]);

    	Message::create([
    		'emmeteurs_id' => 3,
            'conversations_id' => 2,
            'contenu' => 'Sur la branche.' ,
        ]);
    }
}
