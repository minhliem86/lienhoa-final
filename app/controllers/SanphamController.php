<?php
use services\frontend\RepoInterface as Model;

class SanphamController extends BaseController{
	protected $model;

	public function __construct(Model $model){
		$this->model=$model;
	}

	public function sanpham(){
		$danhmuc = $this->model->showdanhmuc(array('Sanpham'));
		if(!$danhmuc->isEmpty()){
			return View::make('pages.sanpham')->with(compact('danhmuc'));
		}else{
			return View::make('errors.404');
		}
		
	}

	public function danhmuc($slug_danhmuc){
		$sanpham = $this->model->sanpham_danhmuc($slug_danhmuc);
		$danhmuc = $this->model->name_danhmuc($slug_danhmuc);
		if(!$sanpham->isEmpty()){
			return View::make('pages.sanphamDanhmuc')->with(compact('sanpham','danhmuc'));
		}else{
			return View::make('errors.404');
		}
		
	}

	public function sanphamDetail($slug_danhmuc,$slug_sp){
		$sanpham = $this->model->sanpham_detail($slug_danhmuc,$slug_sp);
		// print_r($sanpham);
		$sp_relate = $this->model->sp_relate($slug_danhmuc,$slug_sp);
		// return View::make('pages.sanphamDetail')->with(compact('sanpham','sp_relate','slug_danhmuc'));
		if(!$sanpham == null){
			return View::make('pages.sanphamDetail')->with(compact('sanpham','sp_relate','slug_danhmuc'));
		}else{
			return View::make('errors.404');
		}
	}
}