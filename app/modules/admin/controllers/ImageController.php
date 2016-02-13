<?php
namespace admin\controllers;

use services\Image\RepoInterface as Image;
use services\Album\RepoInterface as Album;

use validations\ValidImageForm;
use validations\CustomException\FormValidationException;

class ImageController extends \BaseController {
	protected $image;
	protected $album;
	protected $valid;
	protected $name_project = '';

	public function __construct(Image $image, Album $album, ValidImageForm $validation){
		$this->image = $image;
		$this->album = $album;
		$this->valid = $validation;
		$this->beforeFilter('issetAlbum');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($album_id)
	{
		$image = $this->image->whereGet('album_id',$album_id);
		return \View::make('admin::pages.image.index')->with(compact('image','album_id'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($album_id)
	{
			return \View::make('admin::pages.image.create')->with(compact('album_id'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// return $album_id;
		$get = \Input::get('img');
		$title_arr = \Input::get('title');
		$i = 1;
		if(!is_null($get)){
			foreach($get as $k => $value){
				$sort = $this->image->orderFirstWhere('album_id',\Input::get('album_id'),'sort','DESC');
				if(!isset($sort) && $i == 1){
					$current = 1;
				}elseif( !isset($sort) && $i != 1){
					$current = $i;
				}
				if(isset($sort)){
					$current = $sort->sort + $i;
				}

				$urlhinh_orgi = $value;
				$urlhinh = str_replace($this->name_project, '', $urlhinh_orgi);
				// $thumb_img = \Image::make($url_thumb)->resize(250,158)->save($this->path_thumb.time().'_thumb_'.$name_thumb);
				$text = $title_arr[$k];
				$data[] = array (
					'alt_text'=> $text,
					'slug' => \Unicode::make($text),
					'path_img'=> $urlhinh,
					'show'=>1,
					'album_id'=>\Input::get('album_id'),
					'album_name'=>$this->album->find(\Input::get('album_id'))->title,
					'sort'=>$current
				);
				$i++;
			};
			\DB::table('images')->insert($data);
			\Notification::success('CREATED !');
			return \Redirect::route('admin.image.index',\Input::get('album_id'));
		}else{
			\Notification::error('Please Choose Images');
			return \Redirect::back();
		}
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(!\Input::hasFile('img')){
			$img = \Input::get('img_bk');
			$path_img = $img;
		}else{
			try{
				$this->valid->validate(\Input::all());
			}catch(FormValidationException $e){
				\Notification::error('Please choose Image type: jpg, png, jpeg');
				return \Redirect::back()->withInput();

			}
			$img = \Input::file('img');
			$name = $img->getClientOriginalName();
			$path = 'public/upload/images/';
			$img->move($path,$name);
			$path_img = $path.$name;
		}
		$data = array(
			'alt_text'=> \Input::get('alt_text'),
			'slug'=> \Unicode::make(\Input::get('alt_text')),
			'show'=> \Input::get('show'),
			'sort'=> \Input::get('sort'),
			'path_img'=>$path_img,
		);

		$this->image->update($id,$data);
		\Notification::success('UPDATED !');
		return \Redirect::back();

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
		$this->image->delete($id);
		\Notification::success('DELETED !');
		return \Redirect::back();
	}

	public function deleteall(){
		$check = \Input::get('check');
		if($check){
			$this->image->delete($check);
			\Notification::success('DELETED !');
			return \Redirect::back();
		}else{
			\Notification::error('Please select items to delete !');
			return \Redirect::back();
		}

	}

	public function sort(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$id = \Input::get('id');
			$data= array('sort'=>\Input::get('sort'));
			$this->image->update($id,$data);
			return \Response::json(array('kq'=>\Input::get('sort')));
		}

	}
}
