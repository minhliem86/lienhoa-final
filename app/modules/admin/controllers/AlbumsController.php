<?php
namespace admin\controllers;
use services\Album\RepoInterface as Album;

class AlbumsController extends \BaseController {
	public $album;

	public function __construct(Album $album){
		$this->album=$album;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$album = $this->album->select_all();
		return \View::make('admin::pages.album.index')->with(compact('album'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return \View::make('admin::pages.album.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$sort = $this->album->OrderFirst('sort','DESC');
		if(!isset($sort)){
			$current = 1;
		}else{
			$current = $sort->sort + 1;
		}
		// $urlhinh = \Input::get('file');
		// $urlhinh = str_replace('/startup/', '', $urlhinh);
		$data = array (
			'title'=> \Input::get('title'),
			'slug' => \Unicode::make(\Input::get('title')),
			// 'urlhinh'=> $urlhinh,
			'show'=>1,
			'sort'=>$current
		);
		$this->album->create($data);
		\Notification::success('CREATED !');
		return \Redirect::route('admin.album.index');
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
		$album = $this->album->find($id);
		return \View::make('admin::pages.album.view')->with(compact('album'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = array (
			'title'=> \Input::get('title'),
			'slug' => \Unicode::make(\Input::get('title')),
			'show'=>\Input::get('show'),
			'sort'=>\Input::get('sort'),
		);
		$this->album->update($id,$data);

		\Notification::success('UPDATED !');
		return \Redirect::route('admin.album.index');
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

	public function status(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$id = \Input::get('id');
			$val = \Input::get('value');
			$data = array('show'=>$val);
			$this->album->update($id,$data);
			return \Response::json(array('msg'=>$val));
		}
	}

	public function delete($id){
		$this->album->delete($id);
		\Notification::success('DELETED !');
		return \Redirect::route('admin.album.index');
	}

	public function deleteAll(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$data = \Input::get('arr');
			if(!$data){
				return \Response::json(array('msg'=>'error'));
			}else{
				$this->album->delete($data);
				return \Response::json(array('msg'=>$data));
			}
		}
	}


}
