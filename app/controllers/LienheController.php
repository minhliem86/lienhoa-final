<?php
use services\frontend\RepoInterface as Model;

use validations\CustomerForm as CustomerForm;
use validations\CustomException\FormValidationException as FormValidationException;

class LienheController extends BaseController{
	protected $model;
	protected $valid;

	public function __construct(Model $model, CustomerForm $valid){
		$this->model=$model;
		$this->valid = $valid;
	}

	public function index(){
		$contact = Cache::rememberForever('contact_cache',function(){
			return $this->model->contact();
		});
		$map = $this->model->contact_map();
		$map = json_decode($map);
		return View::make('pages.lienhe')->with(compact('contact','map'));
	}
	public function postCustomer(){
		$input = \Input::all();
		try{
			$this->valid->validate($input);
		}catch(FormValidationException $e){
			return \Redirect::back()->withErrors($e->getErrors())->withInput();
		}
		$data = array(
			'fullname'=>\Input::get('fullname'),
			'email'=>\Input::get('email'),
			'company_name'=>\Input::get('company_name'),
			'phone'=>\Input::get('phone'),
			'message'=>\Input::get('message'),
		);
		$customer = $this->model->pushLienhe($data);
		$email = $this->model->getEmailContact();
		Event::fire('customer.dangki',array($customer,$email));
		return View::make('pages.thanks');
	}
}