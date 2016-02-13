<?php
namespace validations;
use validations\Baseform\Validator;

class CustomerForm extends Validator{
	public function rules(){
		return [
			'fullname'=> 'required|max:200',
			'email'=> 'email|required',
			'phone'=>'required',
		];
	} 
}