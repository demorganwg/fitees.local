<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i = 1; $i <= 30; $i++){
			
			$arr[$i] = [
				'content' => 'Content_example_'.$i,
				'number' => rand(1, 10),
				'topic_id' => rand(1, 10),
			];
			
		}
        
		 DB::table('pages')->insert($arr);
    }
}
