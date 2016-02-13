<?php
namespace services\Image;

use Image;
use services\AbstractEloquent;

class Eloquent extends AbstractEloquent implements RepoInterface{
	protected $model;

	public function __construct(Image $model){
		$this->model = $model;
	}

	public function paginate($sl){
		return $this->model->paginate($sl);
	}

	public function getRand($limit){
		return $this->model->OrderbyRaw('RAND()')->take($limit)->get();
	}

	public function where($column,$operate = '=',$value){
		return $this->model->where($column,$operate, $value)->get();
	}
	
	public function orderFirstWhere($where,$valueWhere,$column,$prop){
		return $this->model->where($where,$valueWhere)->OrderBy($column,$prop)->first();
	}
}