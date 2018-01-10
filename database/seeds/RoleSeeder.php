<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id' => 1,
            'name' => 'teacher',
            'display_name' => 'Teacher',
            ]);

        Role::create([
            'id' => 2,
            'name' => 'student',
            'display_name' => 'Student',
            ]); 

        Role::create([
            'id' => 3,
            'name' => 'parent',
            'display_name' => 'Parent',
            ]); 
    }
}
