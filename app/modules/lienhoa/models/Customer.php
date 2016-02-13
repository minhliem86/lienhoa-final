<?php
namespace lienhoa\models;

class Customer extends \Eloquent{
	public $table = "customer_contact";

	protected $fillable = ['fullname','phone','email','company_name','messages','xem'];

	public static function boot(){
		parent::boot();

		self::created(function($customer){
			\Cache::forget('customer');
		});
		self::updated(function($customer){
			\Cache::forget('customer');
		});
		self::deleted(function($customer){
			\Cache::forget('customer');
		});
	}
}