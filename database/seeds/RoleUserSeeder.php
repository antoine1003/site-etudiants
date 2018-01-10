<?php

use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=1; $i < 15 ; $i++) { 
    		DB::table('role_user')->insert([
            'user_id' => $i,
            'role_id' => rand ( 1 , 2),
        	]);
    	}
    }
}
