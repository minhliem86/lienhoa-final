<?php 
namespace services\Permission;

use Permission;
use services\AbstractEloquent;

class Eloquent extends AbstractEloquent implements RepoInterface{
	protected $model;

	public function __construct(Permission $permission){
		$this->model =$permission;
	}

	public function createGet($data){
		return $this->model->create($data);
	}

	public function whereFirst($column,$data){
		return $this->model->where($column,$data)->first();
	}

	
}