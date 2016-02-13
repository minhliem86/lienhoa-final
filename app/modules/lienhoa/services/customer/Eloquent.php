<?php 
namespace lienhoa\services\customer;

use lienhoa\models\Customer;
use services\AbstractEloquent;

class Eloquent extends AbstractEloquent implements RepoInterface{
	protected $model;

	public function __construct(Customer $customer){
		$this->model = $customer;
	}
}