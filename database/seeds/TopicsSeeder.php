<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
//    	DB::table('topics')->truncate();
		
		$arr[] = [
				'name' => 'Загальна характеристика вищої освіти',
				'description' => 'Вища освіта - це рівень освіти, який здобувається особою у вищому навчальному закладі в результаті послідовного, системного і цілеспрямованого процесу засвоєння змісту навчання, котрий ґрунтується на повній загальній середній освіті та завершується здобуттям певної кваліфікації за підсумками державної атестації.
В Україні підготовка фахівців з вищою освітою, які відповідатимуть потребам суспільства в сучасних умовах, забезпечується ступеневою системою освіти (рис. 1,1). У вищих навчальних закладах реалізується модель вищої професійної освіти, що націлена на підготовку особи до виконання професійної роботи на певних посадах (у відмінності від західної моделі, за якою вищі навчальні заклади реалізують професійно спрямовані освітні програми).',
				'number' => 1,
				'alias' => 'vischa_osvita',
				'course_id' => 1,
			];
			
		$arr[] = [
				'name' => 'Управління навчально-методичною діяльністю',
				'description' => 'Система управління ВНЗ спрямована на створення оптимальних умов для реалізації конституційного права громадян України на одержання вищої освіти згідно із здібностями та потребами особи і базується на принципах:
» розмежування прав, повноважень та відповідальності власника, органів управління вищого освітою, керівництва ВНЗ та його структурних підрозділів;
*	поєднання колегіальних та єдиноначальних засад;
*	незалежності   від  політичних  партій,   громадських  та  релігійнихорганізацій;
«   забезпечення демократичності управління освітньою діяльністю;
« реалізації демократичних свобод усіх учасників освітньої Діяльності та забезпечення академічної відповідальності студентів;
» створення умов для вільного пошуку і викладення та розповсюдження істини;
',
				'number' => 2,
				'alias' => 'navchalno-metodichna-diyalnist',
				'course_id' => 1,
			];
		
		$arr[] = [
				'name' => 'Технології проектування педагогічного процесу',
				'description' => 'Підготовку фахівців з вищою освітоюэегламентують	освітньо-кваліфікаційні
характеристики, засоби діагностики якості їищої освіти, освітньо-професійні програми, Ірограми навчальних дисциплін.
Розробка цих документів грунтується на результатах вивчення й прогнозування :труктури соціальної та виробничої діяльності рахівців з вищою освітою.',
				'number' => 3,
				'alias' => 'tehnologiyi',
				'course_id' => 1,
			];
		
		$arr[] = [
				'name' => 'Організація навчального процесу',
				'description' => 'Навчальний процес - це система організаційних і дидактичних заходів, спрямованих на реалізацію змісту освіти відповідно до системи державних стандартів освіти.
Вищий навчальний заклад надає студентам можливість користування навчальними приміщеннями, бібліотеками, навчально-методичною та науковою літературою, обладнанням, устаткуванням та іншими засобами навчання на умовах, визначених правилами внутрішнього розпорядку.',
				'number' => 4,
				'alias' => 'navchalniy-process',
				'course_id' => 1,
			];
		
		$arr[] = [
				'name' => 'Технології навчання',
				'description' => 'Процес переробки інформації людиною. Для навчання важливі такі функції пам`яті, що характеризують процес переробки інформації людиною:
*	сприймати;
*	усвідомлювати;
*	згадувати;
*	діяти.
Функції пам`яті співвідносять з визначеними носіями, наприклад, "сприймати" - з органами почуттів, "діяти" - з мускулатурою. Носієм функції "усвідомлювати" вважають так звану "короткочасну пам`ять", що не є поняттям із фізіології мозку, а лише терміном, який зручно використовувати при розгляді даної моделі.',
				'number' => 5,
				'alias' => 'navchannya',
				'course_id' => 1,
			];
			
		for($i = 1; $i <= 5; $i++){
			$arr[] = [
				'name' => 'Тема-'.$i,
				'description' => 'Короткий опис змісту теми',
				'number' => $i,
				'alias' => '2-topic-alias-'.$i,
				'course_id' => 2,
			];
		}
		
		for($i = 1; $i <= 5; $i++){
			$arr[] = [
				'name' => 'Тема-'.$i,
				'description' => 'Короткий опис змісту теми',
				'number' => $i,
				'alias' => '3-topic-alias-'.$i,
				'course_id' => 3,
			];
		}
		
		for($i = 1; $i <= 5; $i++){
			$arr[] = [
				'name' => 'Тема-'.$i,
				'description' => 'Короткий опис змісту теми',
				'number' => $i,
				'alias' => '4-topic-alias-'.$i,
				'course_id' => 4,
			];
		}
		
		for($i = 1; $i <= 5; $i++){
			$arr[] = [
				'name' => 'Тема-'.$i,
				'description' => 'Короткий опис змісту теми',
				'number' => $i,
				'alias' => '5-topic-alias-'.$i,
				'course_id' => 5,
			];
		}
		
		for($i = 1; $i <= 5; $i++){
			$arr[] = [
				'name' => 'Тема-'.$i,
				'description' => 'Короткий опис змісту теми',
				'number' => $i,
				'alias' => '6-topic-alias-'.$i,
				'course_id' => 6,
			];
		}
		
		for($i = 1; $i <= 5; $i++){
			$arr[] = [
				'name' => 'Тема-'.$i,
				'description' => 'Короткий опис змісту теми',
				'number' => $i,
				'alias' => '7-topic-alias-'.$i,
				'course_id' => 7,
			];
		}
		
		for($i = 1; $i <= 5; $i++){
			$arr[] = [
				'name' => 'Тема-'.$i,
				'description' => 'Короткий опис змісту теми',
				'number' => $i,
				'alias' => '8-topic-alias-'.$i,
				'course_id' => 8,
			];
		}
		
		for($i = 1; $i <= 5; $i++){
			$arr[] = [
				'name' => 'Тема-'.$i,
				'description' => 'Короткий опис змісту теми',
				'number' => $i,
				'alias' => '9-topic-alias-'.$i,
				'course_id' => 9,
			];
		}
        
		 DB::table('topics')->insert($arr);
    }
}
