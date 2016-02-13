<?php
namespace lienhoa\models;

class Sanpham extends \Eloquent{
	public $table = 'sanpham';

	protected $fillable = ['name','mota','image_path','image_name','status','order','chatlieu','mausac','size','style','noibat','solanxem','slug','danhmuc_name','danhmuc_id'];

	public function danhmuc(){
		return $this->belongsTo('lienhoa\models\Danhmuc','danhmuc_id');
	}

	public static function boot(){
		parent::boot();

		self::created(function(){
			\Cache::forget('sp_khuyenmai');
		});
		self::updated(function(){
			\Cache::forget('sp_khuyenmai');
		});
		self::deleted(function(){
			\Cache::forget('sp_khuyenmai');
		});
	}
}