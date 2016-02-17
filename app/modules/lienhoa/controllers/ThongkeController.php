<?php
namespace lienhoa\controllers;

class ThongkeController extends \BaseController{
	public function getThongke(){
		$site_id = \Analytics::getSiteIdByUrl('http://lienhoafashion.net'); 

		// Điền vào tên miền của bạn, kết quả có dạng 'ga:11111111'
		$optParams = array("dimensions" => "ga:date");
		$stats = \Analytics::query($site_id, '7daysAgo', 'yesterday', 'ga:visits, ga:pageviews',$optParams)->rows;
		
		$date = new \Carbon\Carbon;
		$arr_date = array($date->now()->subWeek()->format('d-m-Y'));
		for($i = 1; $i <=6; $i++){
			$arr_date []= $date->now()->subWeek()->addDays($i)->format('d-m-Y');
		}
		return \View::make('admin::pages.index.index')->with(compact('stats','arr_date'));
	}
}