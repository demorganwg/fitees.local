<?php

use Illuminate\Database\Seeder;

class ResourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for($i = 1; $i <= 20; $i++){
			
			$arr[$i] = [
				'name' => 'Resource_name_'.$i,
				'description' => 'Resource_description_'.$i,
				'number' => rand(1, 10),
				'alias' => 'Resource_alias_'.$i,
				'resource_type_id' => rand(1, 5),
				'course_id' => rand(1, 5),
			];
			
		}
    	
        DB::table('resources')->insert($arr);
        
    }
}
