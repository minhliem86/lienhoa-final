<?php
namespace lienhoa\models;

class Supporter extends \Eloquent{
	public $table = 'supporter';
	protected $fillable = ['name','phone','facebook','glus','yahoo','order','status'];

	public static function boot(){
		parent::boot();

		self::created(function($support){
			\Cache::forget("support");
		});
		self::updated(function($danhmuc){
			\Cache::forget("support");
		});
		self::deleted(function($danhmuc){
			\Cache::forget("support");
		});
	}
}