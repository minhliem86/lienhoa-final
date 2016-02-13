<?php 
namespace services\Contact;

use Contact;
use services\AbstractEloquent;

class Eloquent extends AbstractEloquent implements RepoInterface{
	protected $model;

	public function __construct(Contact $contact){
		$this->model = $contact;
	}
}