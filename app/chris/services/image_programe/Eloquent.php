<?php 
namespace services\image_programe;

use ImagePrograme;
use services\AbstractEloquent;

class Eloquent extends AbstractEloquent implements RepoInterface{
	protected $model;

	public function __construct(ImagePrograme $model){
		$this->model = $model;
	}
}