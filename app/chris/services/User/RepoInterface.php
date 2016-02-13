<?php

namespace services\User;

interface RepoInterface{
	public function select_except($id);

	public function findCurrent();

	public function getRole($id,array $with=array());
}