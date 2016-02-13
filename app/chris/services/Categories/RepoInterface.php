<?php

namespace services\Categories;

interface RepoInterface{

	public function whereFirst($column,$con);

	public function whereAll($column,$con);

	public function WhereOrderFirst($where,$valueWhere,$order_column,$order);

	public function showSlug($slug);

	public function takeLimit($id,$take,$offset);

	public function paginate($num);

	public function select_list($title, $id);

	public function OrderFirst($order_column,$order);
}