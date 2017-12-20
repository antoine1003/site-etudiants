<?php

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
        	['id' => 1, 'title'=>'Devoir Arnaud', 'start_date'=>'2017-12-10','eventcategories_id' => 1, 'end_date'=>'2017-12-10'],
        	['id' => 2, 'title'=>'Cours Antoine', 'start_date'=>'2017-12-11 12:20:00', 'eventcategories_id' => 2, 'end_date'=>'2017-12-11 13:20:00'],
        	['id' => 3, 'title'=>'Cours Arnaud', 'start_date'=>'2017-12-16', 'eventcategories_id' => 2,'end_date'=>'2017-12-22'],
        ];
        foreach ($data as $key => $value) {
        	Event::create($value);
        }
    }
}
