<?php

use Illuminate\Database\Seeder;
use App\Models\Message;

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
    		'recepteurs_id' => 2,
    		'contenu' => 'Bonjour Arnaud, Tu vas bien?',
    	]);

    	Message::create([
    		'emmeteurs_id' => 2,
    		'recepteurs_id' => 1,
    		'contenu' => 'Super et toi?',
    	]);

    	Message::create([
    		'emmeteurs_id' => 1,
    		'recepteurs_id' => 2,
    		'contenu' => 'Bien.J\'espère que tu as bien travaillé !' ,
    	]);

    	Message::create([
    		'emmeteurs_id' => 1,
    		'recepteurs_id' => 3,
    		'contenu' => 'Ou se trouve l\'oiseau? Oui, non, zbradaraldjan?' ,
    	]);

    	Message::create([
    		'emmeteurs_id' => 3,
    		'recepteurs_id' => 1,
    		'contenu' => 'Sur la branche.' ,
    	]);

    	Message::create([
    		'emmeteurs_id' => 1,
    		'recepteurs_id' => 3,
    		'contenu' => 'Jolie mrd xptdr lol' ,
    	]);
    }
}
