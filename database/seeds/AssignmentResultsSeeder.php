<?php

use Illuminate\Database\Seeder;

class AssignmentResultsSeeder extends Seeder
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
				'score' => rand(1, 100),
				'answers' => 'Answers_text_'.$i,
				'user_course_id' => rand(1, 30),
				'assignment_id' => rand(1, 30),
			];
			
		}
    	
        DB::table('assignment_results')->insert($arr);
        
    }
}
