<?php
use services\frontend\RepoInterface as Model;
use lienhoa\services\sanpham\RepoInterface as Backend;

class SanphamController extends BaseController{
	protected $model;
	protected $backend;

	public function __construct(Model $model,Backend $backend){
		$this->model=$model;
		$this->backend=$backend;
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
		$id_sp = $sanpham->id;
		$sp = $this->backend->find($id_sp);
		if($sanpham){
			$ip = \Request::getClientIp();
			if(!\Cache::has($ip."_view_".$slug_sp)){
				$solanxem = $sp->solanxem + 1;
				$sp->solanxem = $solanxem;
				$sp->save();
				Cache::add($ip."_view_".$slug_sp,$solanxem,15);
			}
		}

		$sp_relate = $this->model->sp_relate($slug_danhmuc,$slug_sp);
		if(!$sanpham == null){
			return View::make('pages.sanphamDetail')->with(compact('sanpham','sp_relate','slug_danhmuc'));
		}else{
			return View::make('errors.404');
		}
	}
}