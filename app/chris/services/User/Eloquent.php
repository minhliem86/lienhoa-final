<?php 
namespace services\User;

use User;
use services\AbstractEloquent;

class Eloquent extends AbstractEloquent implements RepoInterface{
	protected $model;

	public function __construct(User $user){
		$this->model =$user;
	}

	public function select_except($id){
		return $this->model->where('id','!=',$id)->get();
	}

	public function findCurrent(){
		return \Auth::user();
	}

	public function getRole($id,array $with=array()){
		$query = $this->make($with);
		return $query->find($id);
	}
}