<?php
class Post extends Eloquent{

	public $table = 'posts';

	protected $fillable = array('title', 'slug' , 'content', 'path_image', 'path_thumb','alt_img', 'cate_id','cate_name','hot', 'sort', 'show');

	public function addition(){
		return $this->hasMany('Addition');
	}

	public function category(){
		return $this->belongsTo('Category','cate_id');
	}
}