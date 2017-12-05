<?php

use Illuminate\Database\Seeder;
use App\Models\Conversation;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Conversation::create([
        	'id' => 1,
        	'users1_id' => 1,
        	'users2_id' => 2,
        ]);

        Conversation::create([
        	'id' => 2,
        	'users1_id' => 1,
        	'users2_id' => 3,
        ]);
    }
}
