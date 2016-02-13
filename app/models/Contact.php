<?php

class Contact extends Eloquent{
	protected $table = "contact";

	protected $fillable = array('phone', 'address', 'email', 'fax', 'map', 'sort','show');

	public static function boot(){
		parent::boot();
		static::created(function(){
			Cache::forget('diachi');
		});
		static::updated(function(){
			Cache::forget('diachi');
		});
	}
}