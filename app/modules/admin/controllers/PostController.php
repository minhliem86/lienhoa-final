<?php
namespace admin\controllers;

use services\Post\RepoInterface as Post;
use services\Categories\RepoInterface as Cate;
use services\PostAddition\RepoInterface as PostAdd;

class PostController extends \BaseController {
	protected $post;
	protected $cate;
	protected $post_add;
	Protected $name_project = '/backend';

	public function __construct(Post $post, Cate $cate, PostAdd $post_add){
		$this->post = $post;
		$this->cate = $cate;
		$this->post_add = $post_add;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$post = $this->post->select_all(array('category'));
		return \View::make('admin::pages.post.index')->with(compact('post'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$list = $this->cate->select_list('title', 'id');
		return \View::make('admin::pages.post.create')->with(compact('list'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$sort = $this->post->OrderFirst('id','DESC');
		count($sort) == 0 ?  $current = 1 :  $current = $sort->sort +1 ;
		if(!\Input::has('file')){
			$path_img = '/public/backend/assets/img/image_thumbnail.gif';
			$alt_name = \GetNameImage::make("/",$path_img);

		}else{
			$ha = \Input::get('file');
			$path_img = str_replace($this->name_project,'', $ha);
			$alt_name = \GetNameImage::make("/",$path_img);

		}
		if(\Input::get('addition') == 0){
			$data = array(
				'title'=> \Input::get('title'),
				'slug' => \Unicode::make(\Input::get('title')),
				'content'=> \Input::get('content'),
				'cate_id' =>\Input::get('cate_id'),
				'cate_name' =>$this->cate->find(\Input::get('cate_id'))->slug,
				'path_thumb' => $path_img,
				'alt_img' => $alt_name,
				'show'=> 1,
				'sort' => $current,
			);
			$this->post->create($data);
		}else{
			$data = array(
				'title'=> \Input::get('title'),
				'slug' => \Unicode::make(\Input::get('title')),
				'content'=> \Input::get('content'),
				'cate_id' =>\Input::get('cate_id'),
				'cate_name' =>$this->cate->find(\Input::get('cate_id'))->slug,
				'path_thumb' => $path_img,
				'alt_img' => $alt_name,
				'show'=> 1,
				'sort' => $current,
			);
			$post_kq = $this->post->createRelate($data);

			$arr_add = \Input::get('attr');
			$va_add = \Input::get('value_attr');

			$data_arr = array();

			foreach($arr_add as $k => $v){
				$data_arr[] = new \Addition(array(
					'key'=> $v,
					'slug'=> \Unicode::make($v),
					'value' => $va_add[$k]
				));

			}

			$post_kq->addition()->saveMany($data_arr);
		}
		\Notification::success('CREATED !');
		return \Redirect::route('admin.post.index');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$list = $this->cate->select_list('title','id');
		$post = $this->post->find($id, array('addition'));
		$count = count($post->addition);
		return \View::make('admin::pages.post.edit')->with(compact('list','post','count'));
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
			$path_img = \Input::get('img-bk');
			$alt_name = \GetNameImage::make('/',$path_img);
		}else{
			$ha = \Input::get('file');
			$path_img = str_replace($this->name_project, '', $ha);
			$alt_name = \GetNameImage::make('/',$path_img);
		}
		$data = array(
			'title'=> \Input::get('title'),
			'slug' => \Unicode::make(\Input::get('title')),
			'content'=> \Input::get('content'),
			'cate_id' =>\Input::get('cate_id'),
			'path_thumb' => $path_img,
			'alt_img'=>$alt_name,
			'show'=> \Input::get('show'),
			'sort' =>\Input::get('sort'),
		);
		$this->post->update($id, $data);

		$post_current = $this->post->find($id);
		$post_add = $this->post_add->whereGet('post_id',$post_current->id);
		$count = $post_add->count();


		if($count != 0){
			$arr_add = \Input::get('attr');
			$va_add = \Input::get('value_attr');
			foreach($arr_add as $k => $each){
				$data = array('key'=>$arr_add[$k], 'slug'=>\Unicode::make($arr_add[$k]), 'value'=>$va_add[$k]);
				$this->post_add->update($each->id,$data);
			}
		}

		\Notification::success('UPDATED !');
		return \Redirect::route('admin.post.index');
	}

	public function removeall(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$data = \Input::get('arr');
			if(!$data){
				return \Response::json(array('msg'=>'error'));
			}else{
				$this->post->delete($data);
				return \Response::json(array('msg'=>'success'));
			}
		}
	}

	public function removeitem($id){
		$this->post->delete($id);
		\Notification::success('Deleted !');
		return \Redirect::back();
	}

	public function removeAddition(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$id = \Input::get('id');
			$this->post_add->delete($id);
			return \Response::json(array('msg'=>'ok'));
		}
	}
	public function removeAdditionWhere(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$id = \Input::get('id');
			$this->post_add->delete_where('post_id',$id);
			return \Response::json(array('msg'=>'ok'));
		}
	}

	public function status(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$id = \Input::get('id');
			$val = \Input::get('value');
			$data = array('show'=>$val);
			$this->post->update($id,$data);

		}
	}

	public function addmoreAddition($post_id){
		$array_modal_attr = \Input::get('modal_attr');
		$array_modal_attr_value = \Input::get('modal_attr_value');

		$data_arr = array();
		if(\Input::has('modal_attr') || \Input::has('modal_attr_value') ){
			foreach($array_modal_attr as $k => $v){
				$data_arr[] = new \Addition(array(
					'key'=> $v,
					'slug'=> \Unicode::make($v),
					'value' => $array_modal_attr_value[$k]
				));
			}
		}

		$currentPost = $this->post->find($post_id);
		$currentPost->addition()->saveMany($data_arr);
		\Notification::success('Done !');
		return \Redirect::back();
	}

}
