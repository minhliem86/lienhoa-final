<?php
namespace lienhoa\services\danhmuc;

use lienhoa\models\Danhmuc;
use services\AbstractEloquent;

class Eloquent extends AbstractEloquent implements RepoInterface{
	protected $model;

	public function __construct(Danhmuc $danhmuc){
		$this->model = $danhmuc;
	}
}