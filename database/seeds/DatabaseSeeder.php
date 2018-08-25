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
        $this->call([QuestionsSeeder::class, AnswersSeeder::class]);
        
        /*$this->call([RolesSeeder::class, GroupsSeeder::class, UsersSeeder::class, 
        ResourceTypesSeeder::class, CoursesSeeder::class, AssignmentsSeeder::class,
        TasksSeeder::class, UserCoursesSeeder::class, AssignmentResultsSeeder::class, 
        TopicsSeeder::class, PagesSeeder::class, ResourcesSeeder::class, QuestionsSeeder::class, AnswersSeeder::class]);*/

    }
}
