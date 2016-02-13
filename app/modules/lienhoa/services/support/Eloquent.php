<?php 
namespace lienhoa\services\support;

use lienhoa\models\Supporter;
use services\AbstractEloquent;

class Eloquent extends AbstractEloquent implements RepoInterface{
	protected $model;

	public function __construct(Supporter $support){
		$this->model = $support;
	}
}