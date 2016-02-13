<?php
namespace services\Image;

interface RepoInterface {

	public function paginate($sl);

	public function getRand($limit);

	public function where($column,$operate = '=',$value);

	public function orderFirstWhere($where,$valueWhere,$column,$prop);

}