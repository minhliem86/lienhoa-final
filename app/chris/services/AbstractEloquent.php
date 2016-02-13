<?php
namespace services;

abstract class AbstractEloquent{

	public function select_all(){
		return $this->model->orderBy('id','DESC')->get();
	}

	public function create($data){
		$this->model->create($data);
	}

	public function find($id){
		return $this->model->find($id);
	}

	public function delete($id){
		$this->model->destroy($id);
	}

	public function deleteAll($column,$data){
		$this->cate->whereIn($column,$data)->delete();
	}

	public function update($id, $data){
		$this->model->where('id',$id)->update($data);
	}

	public function first(){
		return $this->model->first();
	}

	public function OrderFirst($order_column,$order){
		return $this->model->orderBy($order_column, $order)->first();
	}

	public function whereGet($column, $id_column){
		return $this->model->where($column,$id_column)->get();
	}
	public function whereFirst($column, $id_column){
		return $this->model->where($column,$id_column)->first();
	}

	public function make(array $with=array() ){
		return $this->model->with($with);
	}

	public function select_list($show, $title){
		return $this->model->lists($show,$title);
	}


}