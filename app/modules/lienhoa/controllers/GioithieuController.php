<?php
namespace lienhoa\controllers;
use lienhoa\services\gioithieu\RepoInterface as Gioithieu;


class GioithieuController extends \BaseController{
	protected $gioithieu;

	public function __construct(Gioithieu $gioithieu){
		$this->gioithieu = $gioithieu;
	}
	public function index(){
		$method = \Request::method();
		switch ($method) {
			case 'POST':
				$data = array(
					'content' => \Input::get('content'),
					'status' => \Input::get('status')
				);
				if(isset($this->gioithieu->first()->id)){
					$this->gioithieu->update($this->gioithieu->first()->id,$data);
					\Notification::sucess('UPDATED !');
					return \Redirect::back();
				}else{
					$this->gioithieu->create($data);
					\Notification::sucess('CREATED !');
					return \Redirect::back();
				}
				break;

			default:
				$gioithieu = $this->gioithieu->first();
				
				return \View::make('lienhoa::pages.gioithieu.index')->with(compact('gioithieu'));
				break;
		}
	}
}