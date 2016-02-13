<?php
namespace lienhoa\controllers;

use lienhoa\services\news\RepoInterface as News;

class NewsController extends \BaseController {

		protected $news;
		protected $name_project = '';

	public function __construct(News $news){
		$this->news = $news;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$news = $this->news->select_all();
		return \View::make('lienhoa::pages.news.index')->with(compact('news'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return \View::make('lienhoa::pages.news.create');
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

		$order = $this->news->OrderFirst('id','DESC');
		count($order) == 0 ?  $current = 1 :  $current = $order->order +1 ;

		$data = array(
			'title'=> \Input::get('title'),
			'slug'=> \Unicode::make(\Input::get('title')),
			'content' => \Input::get('content'),
			'image_path' => $img_path,
			'image_name' => $img_name,
			'status' => \Input::get('status'),
			'order'=> $current,
		);
		$this->news->create($data);
		\Notification::success('CREATED !');
		return \Redirect::route('admin.tintuc.index');
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
		$news = $this->news->find($id);
		return \View::make('lienhoa::pages.news.view')->with(compact('news'));
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

		$data = array(
			'title'=> \Input::get('title'),
			'slug'=> \Unicode::make(\Input::get('title')),
			'content' => \Input::get('content'),
			'image_path' => $img_path,
			'image_name' => $img_name,
			'status' => \Input::get('status'),
			'order'=> \Input::get('order'),
		);
		$news = $this->news->find($id);
		$news->title = \Input::get('title');
		$news->slug = \Unicode::make(\Input::get('title'));
		$news->content = \Input::get('content');
		$news->image_path = $img_path;
		$news->image_name = $img_name;
		$news->status = \Input::get('status');
		$news->order = \Input::get('order');
		$news->save();

		\Notification::success('UPDATED !');
		return \Redirect::route('admin.tintuc.index');
	}

	public function status(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$id = \Input::get('id');
			$val = \Input::get('value');
			$data = array('status'=>$val);
			$this->news->update($id,$data);
			return \Response::json(array('msg'=>$val));
		}
	}

	public function delete($id){
		$this->news->delete($id);
		\Notification::success('DELETED !');
		return \Redirect::route('admin.tintuc.index');
	}

	public function deleteAll(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$data = \Input::get('arr');
			if(!$data){
				return \Response::json(array('msg'=>'error'));
			}else{
				$this->news->delete($data);
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
			$news = $this->news->find($id);
			$news->order = $val;
			$news->save();
			return \Response::json(array('msg'=>$val));
		}
	}


}
