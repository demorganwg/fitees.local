<?php

use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for($i = 1; $i <= 5; $i++){
			
			$arr[$i] = [
				'name' => 'Course_name_'.$i,
				'description' => '<p>Description_'.$i.'</p>',
				'image' => 'img/course_img_'.$i,
				'alias' => 'course_alias_'.$i,
				'author_id' => rand(0, 20),
			];
			
		}
    	
        DB::table('courses')->insert($arr);
        
    }
}
