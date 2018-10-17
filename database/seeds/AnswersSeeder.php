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
        
//    	DB::table('answers')->truncate();
        
        for($i = 1; $i <= 50; $i++){
			for($j = 1; $j <= 4; $j++){
				$arr[] = [
					'content' => 'Відповідь №'.$j,
					'is_correct' => (bool)random_int(0, 1),
					'question_id' => $i,
				];
			}
		}
        
		 DB::table('answers')->insert($arr);
        
    }
}
