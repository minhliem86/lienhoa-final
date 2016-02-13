<?php
namespace lienhoa\controllers;

use lienhoa\services\support\RepoInterface as Supporter;

class SupporterController extends \BaseController {

		protected $supporter;
		protected $name_project = '';

	public function __construct(Supporter $supporter){
		$this->supporter = $supporter;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$supporter = $this->supporter->select_all();
		if(!$supporter->isEmpty()){
			return \View::make('lienhoa::pages.support.index')->with(compact('supporter'));
		}else{
			return \Redirect::route('admin.support.create');
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return \View::make('lienhoa::pages.support.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$order = $this->supporter->OrderFirst('id','DESC');
		count($order) == 0 ?  $current = 1 :  $current = $order->order +1 ;

		$data = array(
			'name'=> \Input::get('name'),
			'phone'=> \Input::get('phone'),
			'status' => \Input::get('status'),
			'order'=> $current,
		);
		$this->supporter->create($data);
		\Notification::success('CREATED !');
		return \Redirect::route('admin.support.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$supporter = $this->supporter->find($id);
		return \View::make('lienhoa::pages.support.view')->with(compact('supporter'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$supporter = $this->supporter->find($id);
		$supporter->name = \Input::get('name');
		$supporter->phone = \Input::get('phone');
		$supporter->status = \Input::get('status');
		$supporter->order = \Input::get('order');
		$supporter->save();

		\Notification::success('UPDATED !');
		return \Redirect::route('admin.support.index');
	}

	public function status(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$id = \Input::get('id');
			$val = \Input::get('value');
			$supporter = $this->supporter->find($id);
			$supporter->status = $val;
			$supporter->save();
			return \Response::json(array('msg'=>$val));
		}
	}

	public function delete($id){
		$this->supporter->delete($id);
		\Notification::success('DELETED !');
		return \Redirect::route('admin.support.index');
	}

	public function deleteAll(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$data = \Input::get('arr');
			if(!$data){
				return \Response::json(array('msg'=>'error'));
			}else{
				$this->supporter->delete($data);
				return \Response::json(array('msg'=>$data));
			}
		}
	}
	public function order(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$id = \Input::get('id');
			$val = \Input::get('value');
			$supporter = $this->supporter->find($id);
			$supporter->order = $val;
			$supporter->save();
			return \Response::json(array('msg'=>$val));
		}
	}


}
