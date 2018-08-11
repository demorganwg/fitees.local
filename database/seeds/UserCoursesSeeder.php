<?php

use Illuminate\Database\Seeder;

class UserCoursesSeeder extends Seeder
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
				'status' => rand(0, 1),
				'score' => rand(0, 100),
				'user_id' => rand(1, 20),
				'course_id' => rand(1, 5),
			];
			
		}
    	
        DB::table('user_courses')->insert($arr);
        
    }
}
