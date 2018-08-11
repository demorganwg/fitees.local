<?php

use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
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
				'content' => 'Task_content_'.$i,
				'answers' => 'Task_answers_'.$i,
				'correct_answer' => rand(1, 3),
				'assignment_id' => rand(1, 20),
			];
			
		}
    	
        DB::table('tasks')->insert($arr);
        
    }
}
