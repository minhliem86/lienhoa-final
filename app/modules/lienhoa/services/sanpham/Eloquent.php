<?php 
namespace lienhoa\services\sanpham;

use lienhoa\models\Sanpham;
use services\AbstractEloquent;

class Eloquent extends AbstractEloquent implements RepoInterface{
	protected $model;

	public function __construct(Sanpham $sanpham){
		$this->model = $sanpham;
	}

	public function getSanPham_danhmuc($danhmuc_id){
		return $this->model->where('danhmuc_id',$danhmuc_id)->orderBy('id','DESC')->get();
	}
}