<?php
class Album extends Eloquent{
	public $table = 'albums';

	protected $fillable = array('title','urlhinh','sort','show','slug');

	public function image(){
		return $this->hasMany('Image','album_id');
	}
}