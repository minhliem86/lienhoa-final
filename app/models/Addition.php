<?php
class Addition extends Eloquent{
	public $table = 'post_addition';

	protected $fillable = array('key', 'value', 'post_id','slug');

	public function post(){
		return $this->belongsTo('Post','post_id');
	}
}