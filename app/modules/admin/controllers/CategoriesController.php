<?php
namespace admin\controllers;

use services\Categories\RepoInterface as Cate;

use validations\CategoryForm;
use validations\CustomException\FormValidationException;

class CategoriesController extends \BaseController {

	protected $cate;
	protected $validation;

	public function __construct(Cate $cate, CategoryForm $form){
		$this->cate = $cate;
		$this->validation = $form;
		$this->beforeFilter('checkHR',array('only'=>'index'));
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$cate = $this->cate->select_all();
		$list = $this->cate->select_list('title','id');
		return \View::make("admin::pages.cate.index")->with(compact('cate','list'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = \Input::all();
		try{
			$this->validation->validate($input);
		}catch(FormValidationException $e){
			return \Redirect::back()->withInput()->withErrors($e->getErrors());
		}

		$sort = $this->cate->OrderFirst('id','DESC');
		if(isset($sort)){
			$current = $sort->sort + 1;
		}else{
			$current = 1;
		}

		if(!\Input::has('parent_id')){
			$data = array(
				'title'=>\Input::get('title'),
				'show'=>1,
				'slug'=> \Unicode::make(\Input::get('title')),
				'sort'=>$current,
			);
		}else{
			$data = array(
				'title'=>\Input::get('title'),
				'parent_id' => \Input::get('parent_id'),
				'parent_name' => $this->cate->find(\Input::get('parent_id'))->slug,
				'slug'=> \Unicode::make(\Input::get('title')),
				'show'=>1,
				'sort'=>$current,
			);
		}
		$this->cate->create($data);

		\Notification::success('CREATED !');
		return \Redirect::back();
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
		$cate = $this->cate->find($id);
		$list = $this->cate->select_list('title','id');

		return \View::make('admin::pages.cate.edit')->with(compact('cate', 'list'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = \Input::all();
		try{
			$this->validation->validate($input);
		}
		catch(FormValidationException $e){
			return \Redirect::back()->withInput()->withErrors($e->getErrors());
		}
		$data = array(
			'title'=>\Input::get('title'),
			'slug'=> \Unicode::make(\Input::get('title')),
			'parent_id' => \Input::get('parent_id'),
			'show'=>\Input::get('show'),
			'sort'=>\Input::get('sort'),
		);
		$this->cate->update($id, $data);
		
		\Notification::success('UPDATED !');
		return \Redirect::route('admin.category.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function delete($id){
		$this->cate->delete($id);

		\Notification::success('DELETED !');
		return \Redirect::back();
	}

	public function status(){
		if(!\Request::Ajax()){
			return \View::make('404');
		}else{
			$id = \Input::get('id');
			$val = \Input::get('value');
			$data = array(
				'show' => $val,
			);
			$this->cate->update($id, $data);
			// return \Respone::json(array('status'=>''))
		}
	}


}
