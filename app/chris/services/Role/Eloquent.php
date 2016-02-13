<?php 
namespace services\Role;

use Role;
use services\AbstractEloquent;

class Eloquent extends AbstractEloquent implements RepoInterface{
	protected $model;

	public function __construct(Role $role){
		$this->model =$role;
	}

	public function createGet($data){
		return $this->model->create($data);
	}
	
}