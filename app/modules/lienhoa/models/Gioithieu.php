<?php
namespace lienhoa\models;

class Gioithieu extends \Eloquent{
	public $table = 'gioithieu';

	protected $fillable = ['content','show'];
}