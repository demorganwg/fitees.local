<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicsSeeder extends Seeder
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
				'name' => 'Topic_name_'.$i,
				'description' => 'Description_example_'.$i,
				'number' => rand(1, 10),
				'alias' => 'Topic_alias_'.$i,
				'course_id' => rand(1, 5),
			];
			
		}
        
		 DB::table('topics')->insert($arr);
    }
}
