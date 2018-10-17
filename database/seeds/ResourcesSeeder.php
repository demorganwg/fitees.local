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
        
//    	DB::table('resources')->truncate();
        
		$arr[] = [
			'name' => 'Лабораторна робота №1',
			'description' => 'Лабораторна робота, необхідна для закріплення матеріалів теми "Загальна характеристика вищої освіти"',
			'file' => 'Лабораторна робота №1.docx',
			'number' => 1,
			'alias' => 'document-1',
			'resource_type_id' => 2,
			'course_id' => 1,
		];
		
		$arr[] = [
			'name' => 'Лабораторна робота №2',
			'description' => 'Лабораторна робота, необхідна для закріплення матеріалів теми "Управління навчально-методичною діяльністю"',
			'file' => 'Лабораторна робота №2.docx',
			'number' => 4,
			'alias' => 'document-2',
			'resource_type_id' => 2,
			'course_id' => 1,
		];
		
		$arr[] = [
			'name' => 'Лабораторна робота №3',
			'description' => 'Лабораторна робота, необхідна для закріплення матеріалів теми "Технології проектування педагогічного процесу"',
			'file' => 'Лабораторна робота №3.docx',
			'number' => 5,
			'alias' => 'document-3',
			'resource_type_id' => 2,
			'course_id' => 1,
		];
		
		$arr[] = [
			'name' => 'Лабораторна робота №4',
			'description' => 'Лабораторна робота, необхідна для закріплення матеріалів теми "Організація навчального процесу"',
			'file' => 'Лабораторна робота №4.docx',
			'number' => 6,
			'alias' => 'document-4',
			'resource_type_id' => 2,
			'course_id' => 1,
		];
		
		$arr[] = [
			'name' => 'Лабораторна робота №5',
			'description' => 'Лабораторна робота, необхідна для закріплення матеріалів теми "Технології навчання"',
			'file' => 'Лабораторна робота №5.docx',
			'number' => 7,
			'alias' => 'document-5',
			'resource_type_id' => 2,
			'course_id' => 1,
		];
		
		$arr[] = [
			'name' => 'Відео - Вища освіта',
			'description' => 'Відео до лабораторної роботи №1',
			'number' => 2,
			'file' => 'Вища освіта.mp4',
			'alias' => 'video-1',
			'resource_type_id' => 3,
			'course_id' => 1,
		];
		
		$arr[] = [
			'name' => 'Структурна схема вищої освіти',
			'description' => 'Схема з поясненнями до Лабораторної роботи №1',
			'number' => 3,
			'file' => 'Вища освіта.jpg',
			'alias' => 'image-1',
			'resource_type_id' => 4,
			'course_id' => 1,
		];
		
		$arr[] = [
			'name' => 'Файл проекту',
			'description' => 'Проектний файл середовища програмного забезпечення для виконання лабораторних робіт',
			'number' => 3,
			'file' => 'Project.prj',
			'alias' => 'file-1',
			'resource_type_id' => 5,
			'course_id' => 1,
		];
    	
        DB::table('resources')->insert($arr);
        
    }
}
