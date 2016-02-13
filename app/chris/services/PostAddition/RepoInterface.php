<?php

namespace services\PostAddition;

interface RepoInterface{

	public function delete_where($column,$var);

	public function OrderFirst($order_column,$order);
	
}