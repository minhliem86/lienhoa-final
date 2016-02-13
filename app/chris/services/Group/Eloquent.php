<?php 
namespace services\Group;

class Eloquent implements RepoInterface{
	public function find($id){
		return \Sentry::findGroupById($id);
	}

	public function findAllGroup(){
		return \Sentry::findAllGroups();
	}

	public function findGroupByName($name){
		return \Sentry::findGroupByName($name);
	}

	public function create($data){
		\Sentry::createGroup($data);
	}

	

	// public function assignedRole($name,$role){
	// 	$data = \Sentry::where('groupname','=',$name)->first();
	// 	$data->attachRole($role);
	// }
}