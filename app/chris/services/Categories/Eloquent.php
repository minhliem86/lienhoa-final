<?php 
namespace services\Categories;

use Category;
use services\AbstractEloquent;


class Eloquent extends AbstractEloquent implements RepoInterface{
	protected $model;

	public function __construct(Category $cate){
		$this->model = $cate;
	}

	public function whereFirst($column,$con){
		return $this->model->where($colum,$con)->first();
	}

	public function whereAll($column, $con){
		return $this->model->where($column,$con)->get();
	}

	public function WhereOrderFirst($where,$valueWhere,$order_column,$order){
		return $this->model->where($where,$valueWhere)->Orderby($order_column,$oder)->first();
	}

	public function select_list($title,$id){
		return $this->model->lists($title,$id);
	}

	// FRONTEND
	public function paginate($num){
		return $this->model->where('show', 1)->paginate($num);
	}

	public function showSlug($slug){
		return $this->model->where('slug',$slug)->where('show',1)->first();
	}

	public function takeLimit($id, $take,$offset){
		return $this->model->where('id','<',$id)->orderby('id','DESC')->take($take)->offset($offset)->get();
	}
}