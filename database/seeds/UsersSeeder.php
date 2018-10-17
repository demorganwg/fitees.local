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
    	
//    	DB::table('users')->truncate();
    	
    	/*for($i = 1; $i <= 20; $i++){
			
			$arr[$i] = [
				'name' => 'Name_'.$i,
				'surname' => 'Surname_'.$i,
				'email' => 'email_'.$i.'@mail.ru',
				'password' => 'password_'.$i,
				'role_id' => rand(1, 3),
				'group_id' => rand(1, 10),
			];
			
		}*/
		
		//    	$2y$10$8dGfjMSILUJSuzw6rXATquCrj2lCd4JX.qXtuEeH4OfrbY.aHxjSO

		$arr[] = [
			'name' => 'Администратор',
			'surname' => 'Системы',
			'email' => 'admin@test.ru',
			'password' => '$2y$10$8dGfjMSILUJSuzw6rXATquCrj2lCd4JX.qXtuEeH4OfrbY.aHxjSO',
			'role_id' => 4,
			'group_id' => 1,
		];
		
		$arr[] = [
			'name' => 'Преподаватель-1',
			'surname' => 'Преподаватель',
			'email' => 'teacher1@test.ru',
			'password' => '$2y$10$8dGfjMSILUJSuzw6rXATquCrj2lCd4JX.qXtuEeH4OfrbY.aHxjSO',
			'role_id' => 3,
			'group_id' => 2,
		];
		
		$arr[] = [
			'name' => 'Преподаватель-2',
			'surname' => 'Преподаватель',
			'email' => 'teacher2@test.ru',
			'password' => '$2y$10$8dGfjMSILUJSuzw6rXATquCrj2lCd4JX.qXtuEeH4OfrbY.aHxjSO',
			'role_id' => 3,
			'group_id' => 2,
		];
		
		$arr[] = [
			'name' => 'Преподаватель-3',
			'surname' => 'Преподаватель',
			'email' => 'teacher3@test.ru',
			'password' => '$2y$10$8dGfjMSILUJSuzw6rXATquCrj2lCd4JX.qXtuEeH4OfrbY.aHxjSO',
			'role_id' => 3,
			'group_id' => 2,
		];
    	
    	for($i = 1; $i <= 20; $i++){
			$arr[] = [
				'name' => 'Студент-'.$i,
				'surname' => 'Группы-КИ-17м',
				'email' => 'student-4-'.$i.'@test.ru',
				'password' => '$2y$10$8dGfjMSILUJSuzw6rXATquCrj2lCd4JX.qXtuEeH4OfrbY.aHxjSO',
				'role_id' => 2,
				'group_id' => 4,
			];
		}
		
		for($i = 1; $i <= 20; $i++){
			$arr[] = [
				'name' => 'Абитуриент-'.$i,
				'surname' => 'Университета',
				'email' => 'student-3-'.$i.'@test.ru',
				'password' => '$2y$10$8dGfjMSILUJSuzw6rXATquCrj2lCd4JX.qXtuEeH4OfrbY.aHxjSO',
				'role_id' => 2,
				'group_id' => 3,
			];
		}
		
		for($i = 1; $i <= 15; $i++){
			$arr[] = [
				'name' => 'Студент-'.$i,
				'surname' => 'Группы-КСМ-15-1',
				'email' => 'student-5-'.$i.'@test.ru',
				'password' => '$2y$10$8dGfjMSILUJSuzw6rXATquCrj2lCd4JX.qXtuEeH4OfrbY.aHxjSO',
				'role_id' => 2,
				'group_id' => 5,
			];
		}
		
		for($i = 1; $i <= 15; $i++){
			$arr[] = [
				'name' => 'Студент-'.$i,
				'surname' => 'Группы-КСМ-15-2',
				'email' => 'student-6-'.$i.'@test.ru',
				'password' => '$2y$10$8dGfjMSILUJSuzw6rXATquCrj2lCd4JX.qXtuEeH4OfrbY.aHxjSO',
				'role_id' => 2,
				'group_id' => 6,
			];
		}
		
		for($i = 1; $i <= 15; $i++){
			$arr[] = [
				'name' => 'Студент-'.$i,
				'surname' => 'Группы-КСМ-16-1',
				'email' => 'student-7-'.$i.'@test.ru',
				'password' => '$2y$10$8dGfjMSILUJSuzw6rXATquCrj2lCd4JX.qXtuEeH4OfrbY.aHxjSO',
				'role_id' => rand(1, 2),
				'group_id' => 7,
			];
		}
		
		for($i = 1; $i <= 15; $i++){
			$arr[] = [
				'name' => 'Студент-'.$i,
				'surname' => 'Группы-КСМ-16-2',
				'email' => 'student-8-'.$i.'@test.ru',
				'password' => '$2y$10$8dGfjMSILUJSuzw6rXATquCrj2lCd4JX.qXtuEeH4OfrbY.aHxjSO',
				'role_id' => rand(1, 2),
				'group_id' => 8,
			];
		}
		
		for($i = 1; $i <= 15; $i++){
			$arr[] = [
				'name' => 'Студент-'.$i,
				'surname' => 'Группы-КСМ-17-1',
				'email' => 'student-9-'.$i.'@test.ru',
				'password' => '$2y$10$8dGfjMSILUJSuzw6rXATquCrj2lCd4JX.qXtuEeH4OfrbY.aHxjSO',
				'role_id' => rand(1, 2),
				'group_id' => 9,
			];
		}
		
		for($i = 1; $i <= 15; $i++){
			$arr[] = [
				'name' => 'Студент-'.$i,
				'surname' => 'Группы-КСМ-17-2',
				'email' => 'student-10-'.$i.'@test.ru',
				'password' => '$2y$10$8dGfjMSILUJSuzw6rXATquCrj2lCd4JX.qXtuEeH4OfrbY.aHxjSO',
				'role_id' => rand(1, 2),
				'group_id' => 10,
			];
		}
    	
        DB::table('users')->insert($arr);
    }
}
