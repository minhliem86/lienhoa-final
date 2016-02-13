<?php
namespace admin\controllers;

use services\User\RepoInterface as User;
class UserController extends \BaseController {

	protected $user;
	protected $newpass = "123";

	public function __construct(User $user){
		$this->user = $user;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// $user = $this->user->select_except($this->user->findCurrent()->id);
		$user = $this->user->select_all();
		return \View::make('admin::pages.user.index')->with(compact('user'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return \View::make('admin::pages.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		// $user = $this->user->find($id);
		// $group = $user->getGroups();
		// $all_g = \Sentry::findAllGroups();

		// echo "<pre>";
		// foreach($all_g as $item){
		// 	print_r($item->id);
		// }
		// echo "</pre>";
		// return \View::make('admin::pages.user.editGroup')->with(compact('user','group'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

	public function getLogin(){
		return \View::make('admin::pages.login');
	}

	public function postLogin(){
		// try{
		// 	$data = array(
		// 		'email'=>\Input::get('email'),
		// 		'password' => \Input::get('password'),
		// 	);
		// 	$this->user->login($data);
		// 	// \Notification::success('User Created !');
		// 	return \Redirect::intended('admin/dashboard');
		// }
		// catch(\Cartalyst\Sentry\Users\LoginRequiredException $e){
		// 	\Notification::error('Email field is required !');
		// 	return \Redirect::back();
		// }
		// catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
		// {
		//     	\Notification::error('Password field is required !');
		// 	return \Redirect::back();
		// }
		// catch (\Cartalyst\Sentry\Users\WrongPasswordException $e)
		// {
		//     	\Notification::error('Password is wrong !');
		// 	return \Redirect::back();
		// }
		// catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		// {
		//     	\Notification::error('Email is not found !');
		// 	return \Redirect::back();
		// }
	}

	public function getLogout(){
		// \Sentry::logout();
		// return \Redirect::route('getLogin')->with('ok','Logout is successful. See you later !');
	}

	public function deleteall(){
		// if(!\Request::ajax()){
		// 	return \View::make('404');
		// }else{
		// 	$data = \Input::get('arr');
		// 	if(!$data){
		// 		return \Response::json(array('msg'=>'error'));
		// 	}else{
		// 		$this->post->delete($data);
		// 		return \Response::json(array('msg'=>'success'));
		// 	}
		// }
	}

	public function delete($id){
		// $this->post->delete($id);
		// \Notification::success('Deleted !');
		// return \Redirect::back();
	}

	public function resetPass($id){
		// $user = $this->user->find($id);
		// $user->password = $this->newpass;	
		// $user->save();

		// $data = array('user'=>$user->first_name,'email'=>$user->email,'newpass'=>$this->newpass);
		// \Mail::send('admin::emails.resetpassword',$data, function($msg) use($data){
		// 	$msg->from('trungtamthongbao@gmail.com', 'Admin');
		// 	$msg->to($data['email'], 'Reset Password')->subject('Reset Password');
		// });

		// \Notification::success("New Password sent to user's email");
		// return \Redirect::back();
	}



}
