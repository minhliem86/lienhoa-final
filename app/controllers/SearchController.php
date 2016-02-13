<?php
use services\frontend\RepoInterface as Model;

class SearchController extends BaseController{
	protected $model;

	public function __construct(Model $model){
		$this->model = $model;
	}

	public function search(){
		$keyword = \Input::get('key');
		$result = $this->model->search($keyword);
		// print_r($result->count());
		return View::make('pages.search')->with(compact('result','keyword'));
	}
}