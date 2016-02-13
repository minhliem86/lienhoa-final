<?php

use Faker\Factory as Faker;

class TintucTableSeeder extends Seeder{
	public function run(){
		$faker = Faker::create();
		for($i=0; $i<30; $i++){
			$news = lienhoa\models\News::create([
				'title'=> $faker->name,
				'content'=> $faker->paragraph,
				'image_path'=> $faker->imageUrl(400,300),
				'image_name'=> $faker->word,
				'status'=>1
			]);
		}
	}
}