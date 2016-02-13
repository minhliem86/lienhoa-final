<?php
class Image extends Eloquent{
	public $table = "images";

	protected $fillable = array('alt_text', 'slug', 'album_id','album_name', 'sort', 'show');

	public function album(){
		return $this->belongsTo('Album','album_id');
	}

	public static function boot(){
		parent::boot();
		static::created(function(){
			Cache::forget('banner');
		});
		static::updated(function(){
			Cache::forget('banner');
		});

		static::deleted(function(){
			Cache::forget('banner');
		});
	}
}