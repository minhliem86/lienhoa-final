<?php
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	public $fillable = array('name');

	public function permission(){
		return $this->belongsToMany('Permission','permission_role');
	}
}