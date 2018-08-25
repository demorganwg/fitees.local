<?php

use Illuminate\Database\Seeder;

class AnswersSeeder extends Seeder
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
				'content' => 'Пример ответа №'.$i,
				'is_correct' => (bool)random_int(0, 1),
				'question_id' => rand(1, 30),
			];
			
		}
        
		 DB::table('answers')->insert($arr);
        
    }
}
