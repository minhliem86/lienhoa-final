<?php
namespace validations;
use validations\Baseform\Validator;

class RolePerForm extends Validator{
	public function rules(){
		return [
			'name_role' => 'required|between:3,128|unique:roles,name',
		];
	}
}