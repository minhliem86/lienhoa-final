<?php
namespace validations;

use validations\Baseform\Validator;

class CategoryForm extends Validator{
	public function rules(){
		return array(
			'title'=>'required'
		);
	}
} 