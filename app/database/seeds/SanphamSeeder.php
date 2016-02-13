<?php

use Faker\Factory as Faker;
class SanphamSeeder extends Seeder{
	public function run(){
		$faker = Faker::create();
		for($i=0; $i<50;$i++){
			$sanpham = \lienhoa\models\Sanpham::create([
				'name'=> $faker->name,
				'mota'=> $faker->paragraph,
				'chatlieu' => $faker->sentence,
				'mausac' => $faker->colorName,
				'size' => $faker->username,
				'style' => $faker->state,
				'style' => $faker->state,
				'image_path' => $faker->imageUrl($width = 500, $height = 320),
				'status' =>1,
				'danhmuc_id' => 1,
			]);
		}
	}
}