<?php 
namespace services\Post;

use Post;
use services\AbstractEloquent;

class Eloquent extends AbstractEloquent implements RepoInterface{
	protected $model;

	public function __construct(Post $post){
		$this->model = $post;
	}

	public function createRelate($data){
		return $this->model->create($data);
	}

	public function find_Relate($id, array $with = array()){
		$query = $this->make($with);
		return $query->find($id);
	}
}