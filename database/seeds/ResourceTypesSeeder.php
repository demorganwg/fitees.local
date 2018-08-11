<?php

use Illuminate\Database\Seeder;

class ResourceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('resource_types')->insert([
        
            ['name' => 'Uncategorized'],
            ['name' => 'Document'],
            ['name' => 'Video'],
            ['name' => 'Image'],
            ['name' => 'File'],

        ]);
        
    }
}
