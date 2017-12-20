<?php

use Illuminate\Database\Seeder;
use App\Models\EventUser;

class EventUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        EventUser::create([
            'users_id'  => 1,
            'events_id' => 1,
            'creator'   => true,
        ]);
        EventUser::create([
            'users_id'  => 2,
            'events_id' => 1,
        ]);
        EventUser::create([
            'users_id'  => 1,
            'events_id' => 2,
            'creator'   => true,
        ]);
        EventUser::create([
            'users_id'  => 2,
            'events_id' => 2,
        ]);
        EventUser::create([
            'users_id'  => 3,
            'events_id' => 3,
        ]);
        EventUser::create([
            'users_id'  => 1,
            'events_id' => 3,
            'creator'   => true,
        ]);
    }
}
