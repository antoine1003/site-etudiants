<?php

use Illuminate\Database\Seeder;
use App\Models\BlockedUser;
use Carbon\Carbon;

class BlockedUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlockedUser::create([
        	'time_start' =>  Carbon::now(),
        	'time_stop' =>  Carbon::now()->addWeeks(3),
        	'users_id' => 3,
        	'comments' => 'Vulgarité auprès de plusieurs élèves.',
        ]);
    }
}
