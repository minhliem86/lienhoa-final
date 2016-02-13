<?php
namespace services\Group;

interface RepoInterface{

	public function find($id);

	public function findAllGroup();

	public function findGroupByName($name);

	public function create($data);
}