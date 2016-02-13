<?php

class Category extends Eloquent{
	public $table = "categories";

	protected $fillable = array('title', 'slug', 'parent_id','parent_name', 'sort', 'show');

	public function post(){
		return $this->hasMany('Post');
	}
}