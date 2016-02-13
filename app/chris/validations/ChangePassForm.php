<?php
namespace validations;
use validations\Baseform\Validator;

class ChangePassForm extends Validator{
	public function rules(){
		return array(
			'password' => 'required',
			'newpassword'=> 'required|min:4',
			'comfirm_pass'=>'same:newpassword',
		);
	}
}