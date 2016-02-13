<?php
namespace services\Album;

use Album;
use services\AbstractEloquent;

class Eloquent extends AbstractEloquent implements RepoInterface{
	protected $model;

	public function __construct(Album $album){
		$this->model=$album;
	}
	
	public function  listbyid($id,$key,$val){
		return $this->find($id)->lists($key,$val);
	}

	public function lists($key,$val){
		return $this->model->lists($key,$val);
	}

	public function whereFirst($column,$value, $operate = '='){
		return $this->model->where($column,$operate,$value)->first();
	}
}