<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        
            ['name' => 'Unknown'],
            ['name' => 'Student'],
            ['name' => 'Teacher'],
            ['name' => 'Admin'],

        ]);
    }
}
