<?php
namespace lienhoa\models;

class News extends \Eloquent{
	protected $table = 'news';

	protected $fillable = ['title','content','image_path','image_name','status','order','slug'];

	public static function boot(){
		parent::boot();

		self::created(function($new){

		});
		self::updated(function($new){

		});
		self::deleted(function($new){

		});
	}
}