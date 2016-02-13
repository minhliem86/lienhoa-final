<?php
namespace services\Album;

interface RepoInterface {

	public function listbyid($id,$key,$val);

	public function lists($key,$val);

	public function whereFirst($column,$value,$operate = '=');

}