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
        
        for($i = 1; $i <= 30; $i++){
			
			$arr[$i] = [
				'name' => 'Assignment_name_'.$i,
				'description' => 'Assignment_description_'.$i,
				'number' => rand(1, 10),
				'alias' => 'Assignment_alias_'.$i,
				'course_id' => rand(1, 5),
			];
			
		}
    	
        DB::table('assignments')->insert($arr);
        
    }
}
