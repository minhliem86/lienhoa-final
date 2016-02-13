<?php
Route::get('lienhoafashionadmin',array('as'=>'getLogin','before'=>'checkLogined', 'uses'=>'admin\controllers\UsersController@login'));
Route::post('admin/login',array('as'=>'postLogin', 'uses'=>'admin\controllers\UsersController@doLogin'));

Route::group(array('prefix' => 'admin', 'namespace' =>'admin\controllers','before'=>'checkAdmin'), function(){
	Route::get('dashboard',array('as'=> 'dashboard',function(){
		return  \View::make('admin::pages.index.index');
	}));
	// CATE
	Route::get('category/delete/{id}', array('as' => 'admin.category.delete', 'uses' => 'CategoriesController@delete'))->where(array('id'=>'[0-9]+'));
	Route::post('category/show',array('as'=>'admin.category.status', 'uses' => 'CategoriesController@status'));
	
	Route::resource('category', 'CategoriesController');
	
	//POST
	Route::post('post/remove-all', array('as'=>'admin.post.removeAll', 'uses'=>'PostController@removeall'));
	Route::get('post/remove-item/{id}', array('as'=>'admin.post.remove-item', 'uses'=>'PostController@removeitem'))->where('id','[0-9]+');
	Route::post('post/remove-addition',array('as'=>'admin.post.remove_addition', 'uses'=>'PostController@removeAddition'));
	Route::post('post/removeAdditionWhere', array('as'=>'admin.post.remove_add_edit', 'uses'=>'PostController@removeAdditionWhere'));
	Route::post('post/status',array('as'=>'admin.post.status', 'uses'=>'PostController@status'));
	Route::post('test/more-addition/{post_id}', array('as'=>'admin.post.more_addition', 'uses'=>'PostController@addmoreAddition'))->where('post_id','[0-9]+');

	Route::resource('post','PostController');

	// ALBUM
	Route::post('album/status',array('as'=>'admin.album.status', 'uses'=>'AlbumsController@status'));
	Route::get('album/delete/{id}',array ('as'=>'admin.album.delete', 'uses'=>'AlbumsController@delete'))->where('id','[0-9]+');
	Route::post('album/deleteAll',array ('as'=>'admin.album.deleteAll', 'uses'=>'AlbumsController@deleteAll'));

	Route::resource('album','AlbumsController');

	// IMAGE
	Route::get('album/images/{album_id}',array('as' => 'admin.image.index','uses'=>'ImageController@index'))->where('album_id','[0-9]+');
	Route::get('album/images/create/{album_id}',array('as'=>'admin.image.create','uses'=>'ImageController@create'))->where('album_id','[0-9]+');
	Route::post('album/images/store',array('as'=>'admin.image.store','uses'=>'ImageController@store'));

	Route::post('album/images/update/{image_id}',array('as'=>'admin.image.update','uses'=>'ImageController@update'))->where('image_id','[0-9]+');

	Route::get('images/delete/{id}',array ('as'=>'admin.image.delete','before'=>'checkHR', 'uses'=>'ImageController@delete'))->where('id','[0-9]+');
	Route::post('images/deleteall',array ('as'=>'admin.image.deleteall', 'uses'=>'ImageController@deleteall'));
	Route::post('images/sort',array ('as'=>'admin.image.sort', 'uses'=>'ImageController@sort'));
	

	// USER
	Route::get('logout',array('as'=> 'getLogout','uses' => 'UsersController@logout'));
	Route::post('user/deletall', array('as'=>'admin.user.deleteall', 'uses'=>'UsersController@deleteall'));
	Route::get('user/delete/{id}', array('as'=>'admin.user.delete', 'uses'=>'UsersController@delete'))->where('id','[0-9]+');
	Route::get('user/resetPassword/{id}', array('as'=>'admin.user.resetPass', 'uses'=>'UsersController@resetPass'))->where('id','[0-9]+');
	Route::get('account/changePassword',array('as'=>'admin.user.changePass', 'uses'=>'UsersController@changePass'));
	Route::post('account/changePassword',array('as'=>'admin.user.dochangePass', 'uses'=>'UsersController@dochangePass'));

	//ROLE
	Route::get('user/role', array('as'=>'admin.user.createRole', 'uses'=>'UsersController@createRole'));
	Route::post('user/role', array('as'=>'admin.user.docreateRole', 'uses'=>'UsersController@docreateRole'));
	Route::get('user/{id}/role/update', array('as'=>'admin.user.updateRole', 'uses'=>'UsersController@updateRole'))->where('id','[0-9]+');
	Route::post('user/{id}/role/update', array('as'=>'admin.user.doupdateRole', 'uses'=>'UsersController@doupdateRole'))->where('id','[0-9]+');
	
	Route::resource('user','UsersController');

	// CONTACT INFORMATION
	Route::get('contact',array('as'=>'admin.contact','uses'=>'ContactController@index') );
	Route::post('contact',array('as'=>'admin.contact.post','uses'=>'ContactController@post'));


});

Route::get('admin/account/forget',array('as'=>'admin.account.forget', 'uses'=>'admin\controllers\UsersController@forgotPassword'));
Route::post('admin/account/forget',array('as'=>'admin.account.doforget', 'uses'=>'admin\controllers\UsersController@doForgotPassword'));
Route::get('admin/account/reset-password/{token}',array('as'=>'admin.account.reset', 'uses'=>'admin\controllers\UsersController@resetPassword'))->where('token','[a-zA-Z0-9._\-]+');
Route::post('admin/account/reset-password',array('as'=>'admin.account.doreset', 'uses'=>'admin\controllers\UsersController@doResetPassword'));

Route::get('menu',function(){
	return \View::make('admin::pages.menu');
});

// App::missing(function($exception)
// {
//     return \View::make('admin::pages.404');
// });
// Route::get('create-user', function(){
// 	$data = array(
// 		'email'=>'minhliemphp@gmail.com',
// 		'password'=>'123456',
// 		'activated'=>true,
// 	);
// 	\Sentry::getUserProvider()->create($data);
// 	return "Donee";
// });

