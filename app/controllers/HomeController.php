<?php

use services\frontend\RepoInterface as Model;
class HomeController extends BaseController {
	protected $model;

	public function __construct(Model $model){
		$this->model = $model;
	}
	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}
	public function index(){
		$sp_moinhat = $this->model->sp_moinhat();
		$sp_xemnhieu = $this->model->sp_xemnhieu();
		return View::make('pages.home')->with(compact('sp_moinhat','sp_xemnhieu'));
	}

}
