<?php

namespace services\Post;

interface RepoInterface{

	public function createRelate($data);

	public function find_Relate($id, array $with = array());

}