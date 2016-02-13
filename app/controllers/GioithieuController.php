<?php
use services\frontend\RepoInterface as Model;

class GioithieuController extends BaseController{
	protected $model;

	public function __construct(Model $model){
		$this->model = $model;
	}

	public function index(){
		$gioithieu = Cache::rememberForever('gioithieu_cache',function(){
			return $this->model->gioithieu();
		});
		return View::make('pages.gioithieu')->with(compact('gioithieu'));
	}
}