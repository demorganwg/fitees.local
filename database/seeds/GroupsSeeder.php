<?php

use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
        
            ['name' => 'Администраторы'],
            ['name' => 'Преподаватели'],
            ['name' => 'Абитуриенты'],
            ['name' => 'КИ-17м'],
	        ['name' => 'КСМ-15-1'],
	        ['name' => 'КСМ-15-2'],
	        ['name' => 'КСМ-16-1'],
	        ['name' => 'КСМ-16-2'],
	        ['name' => 'КСМ-17-1'],
	        ['name' => 'КСМ-17-2'],

        ]);
        
    }
}
