<?php

namespace services\Permission;

interface RepoInterface{
	public function createGet($data);

	public function whereFirst($column,$data);
}