<?php
namespace lienhoa\models;


class Danhmuc extends \Eloquent{
	public $table = 'danhmuc';

	protected $fillable = ['title','mota','image_path','image_name','status','order','slug'];

	public function sanpham(){
		return $this->hasMany('lienhoa\models\Sanpham','danhmuc_id');
	}

	public static function boot(){
		parent::boot();

		self::created(function($danhmuc){
			\Cache::forget("danhmuc-cache");
			\Cache::forget("danhmuc_sidebar");
		});
		self::updated(function($danhmuc){
			\Cache::forget("danhmuc-cache");
			\Cache::forget("danhmuc_sidebar");
		});
		self::deleted(function($danhmuc){
			\Cache::forget("danhmuc-cache");
			\Cache::forget("danhmuc_sidebar");
		});
	}
}