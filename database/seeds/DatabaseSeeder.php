<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

		Eloquent::unguard();

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call([
        	RolesSeeder::class, 
        	GroupsSeeder::class,
        	ResourceTypesSeeder::class, 
        	UsersSeeder::class, 
        	CoursesSeeder::class, 
        	TopicsSeeder::class,
        	PagesSeeder::class,
        	ResourcesSeeder::class,
        	AssignmentsSeeder::class,
        	QuestionsSeeder::class,
        	AnswersSeeder::class,
			UserCoursesSeeder::class, 
			AssignmentResultsSeeder::class, 
        ]);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
