<?php

use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for($i = 1; $i <= 30; $i++){
			
			$arr[$i] = [
				'content' => 'сть много вариантов Lorem Ipsum, но большинство из них имеет не всегда приемлемые модификации, например, юмористические вставки или слова, которые даже отдалённо не напоминают латынь. Вопрос №'.$i,
				'assignment_id' => rand(1, 30),
			];
			
		}
        
		 DB::table('questions')->insert($arr);
        
    }
}
