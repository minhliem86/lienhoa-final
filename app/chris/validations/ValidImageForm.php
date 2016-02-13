<?php
namespace validations;
use validations\Baseform\Validator;

class ValidImageForm extends Validator{
	public function rules(){
		return array(
			'img' => 'image|mimes:jpg,jpeg,png'
		);
	}
}