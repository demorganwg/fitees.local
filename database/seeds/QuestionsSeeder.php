<?php

use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
//    	DB::table('questions')->truncate();

		for($i = 1; $i <= 5; $i++){
			for($j = 1; $j <= 10; $j++){
				$arr[] = [
					'content' => 'Запитання №'.$j.' до модуля №'.$i.'. Оберіть вірну відповідь',
					'number' => $j,
					'assignment_id' => $i,
				];
			}
		}
		
		
        
		 DB::table('questions')->insert($arr);
        
    }
}
