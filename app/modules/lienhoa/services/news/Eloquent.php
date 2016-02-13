<?php 
namespace lienhoa\services\news;

use lienhoa\models\News;
use services\AbstractEloquent;

class Eloquent extends AbstractEloquent implements RepoInterface{
	protected $model;

	public function __construct(News $news){
		$this->model = $news;
	}
}