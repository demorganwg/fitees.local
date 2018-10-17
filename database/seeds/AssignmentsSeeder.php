<?php

use Illuminate\Database\Seeder;

class AssignmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
//    	DB::table('assignments')->truncate();
        
        for($i = 1; $i <= 5; $i++){
			
			$arr[$i] = [
				'name' => 'Модуль '.$i,
				'description' => 'Модуль '.$i.' містить 5 запитань. Даний модуль підводить підсумки трьотижневого навчання студента за курсом',
				'number' => $i,
				'alias' => 'assignment-'.$i,
				'course_id' => 1,
			];
			
		}
    	
        DB::table('assignments')->insert($arr);
        
    }
}
