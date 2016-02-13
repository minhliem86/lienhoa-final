<?php
namespace lienhoa\controllers;

use lienhoa\services\danhmuc\RepoInterface as Danhmuc;

class DanhmucController extends \BaseController {
	protected $danhmuc;
	protected $name_project = '';

	public function __construct(Danhmuc $danhmuc){
		$this->danhmuc=$danhmuc;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$danhmuc = $this->danhmuc->select_all();
		return \View::make('lienhoa::pages.danhmuc.index')->with(compact('danhmuc'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return \View::make('lienhoa::pages.danhmuc.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!\Input::has('file')){
			$img_path = '/public/backend/img/image_thumbnail.gif';
			$img_name = \GetNameImage::make("/",$img_path);
		}else{
			$img = \Input::get('file');
			$img_path = str_replace($this->name_project,'',$img);
			$img_name = \GetNameImage::make("/",$img_path);
		}

		$order = $this->danhmuc->OrderFirst('id','DESC');
		count($order) == 0 ?  $current = 1 :  $current = $order->order +1 ;

		$data = array(
			'title'=> \Input::get('title'),
			'slug'=> \Unicode::make(\Input::get('title')),
			'mota' => \Input::get('mota'),
			'image_path' => $img_path,
			'image_name' => $img_name,
			'status' => \Input::get('status'),
			'order'=> $current,
		);

		$this->danhmuc->create($data);
		\Notification::success('CREATED !');
		return \Redirect::route('admin.danhmuc.index');
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
		$danhmuc = $this->danhmuc->find($id);
		return \View::make('lienhoa::pages.danhmuc.view')->with(compact('danhmuc'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(!\Input::has('file')){
			$img_path = \Input::get('img-bk');
			if(empty($img_path)){
				$img_path = '/public/backend/img/image_thumbnail.gif';
			}
			$img_name = \GetNameImage::make('/',$img_path);
		}else{
			$ha = \Input::get('file');
			$img_path = str_replace($this->name_project, '', $ha);
			$img_name = \GetNameImage::make('/',$img_path);
		}

		$danhmuc = $this->danhmuc->find($id);
		$danhmuc->title = \Input::get('title');
		$danhmuc->slug = \Unicode::make(\Input::get('title'));
		$danhmuc->mota = \Input::get('mota');
		$danhmuc->image_path = $img_path;
		$danhmuc->image_name = $img_path;
		$danhmuc->image_name = $img_path;
		$danhmuc->status = \Input::get('status');
		$danhmuc->order = \Input::get('order');
		$danhmuc->save();

		\Notification::success('UPDATED !');
		return \Redirect::route('admin.danhmuc.index');
	}

	public function status(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$id = \Input::get('id');
			$val = \Input::get('value');
			$data = array('status'=>$val);
			$this->danhmuc->update($id,$data);
			return \Response::json(array('msg'=>$val));
		}
	}

	public function delete($id){
		$this->danhmuc->delete($id);
		\Notification::success('DELETED !');
		return \Redirect::route('admin.danhmuc.index');
	}

	public function deleteAll(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$data = \Input::get('arr');
			if(!$data){
				return \Response::json(array('msg'=>'error'));
			}else{
				$this->danhmuc->delete($data);
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
			$danhmuc = $this->danhmuc->find($id);
			$danhmuc->order = $val;
			$danhmuc->save();
			return \Response::json(array('msg'=>$val));
		}
	}


}
