<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
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
				'name' => 'Name_'.$i,
				'surname' => 'Surname_'.$i,
				'email' => 'email_'.$i.'@mail.ru',
				'password' => 'password_'.$i,
				'role_id' => rand(1, 3),
				'group_id' => rand(1, 10),
			];
			
		}
    	
        DB::table('users')->insert($arr);
    }
}
