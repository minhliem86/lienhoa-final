<?php
namespace lienhoa\controllers;

use lienhoa\services\customer\RepoInterface as Customer;

class CustomerController extends \BaseController {
	protected $customer;

	public function __construct(Customer $customer){
		$this->customer = $customer;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$customer = $this->customer->select_all();
		return \View::make('lienhoa::pages.customer.index')->with(compact('customer'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$customer = $this->customer->find($id);
		$customer->xem = 1;
		$customer->save();
		return \View::make('lienhoa::pages.customer.view')->with(compact('customer'));
	}

	public function delete($id){
		$this->customer->delete($id);
		\Notification::success('DELETED !');
		return \Redirect::route('admin.customer.index');
	}

	public function deleteAll(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$data = \Input::get('arr');
			if(!$data){
				return \Response::json(array('msg'=>'error'));
			}else{
				$this->customer->delete($data);
				return \Response::json(array('msg'=>$data));
			}
		}
	}

}
