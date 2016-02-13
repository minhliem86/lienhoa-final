<?php
Route::group(array('prefix'=>'admin','before'=>'checkAdmin','namespace'=>'lienhoa\controllers'),function(){
	// GIOITHIEU
	Route::any('gioithieu',array('as'=>'admin.gioithieu.index','uses'=>'GioithieuController@index'));

	// TINTUC
	Route::post('tintuc/status',array('as'=>'admin.tintuc.status', 'uses'=>'NewsController@status'));
	Route::get('tintuc/delete/{id}',array ('as'=>'admin.tintuc.delete', 'uses'=>'NewsController@delete'))->where('id','[0-9]+');
	Route::post('tintuc/deleteAll',array ('as'=>'admin.tintuc.deleteAll', 'uses'=>'NewsController@deleteAll'));
	Route::resource('tintuc','NewsController');

	// DANHMUC
	Route::post('danhmuc/status',array('as'=>'admin.danhmuc.status', 'uses'=>'DanhmucController@status'));
	Route::get('danhmuc/delete/{id}',array ('as'=>'admin.danhmuc.delete', 'uses'=>'DanhmucController@delete'))->where('id','[0-9]+');
	Route::post('danhmuc/deleteAll',array ('as'=>'admin.danhmuc.deleteAll', 'uses'=>'DanhmucController@deleteAll'));
	Route::post('danhmuc/order',array('as'=>'admin.danhmuc.order', 'uses'=>'DanhmucController@order'));

	Route::resource('danhmuc','DanhmucController');

	//SANPHAM
	Route::get('sanpham/{danhmuc_id}',array('as'=>'admin.sanpham.index','uses'=>'SanphamController@index'))->where(['danhmuc_id'=>'[0-9]+']);
	Route::get('sanpham/create/{danhmuc_id}',array('as'=>'admin.sanpham.create','uses'=>'SanphamController@create'))->where(['danhmuc_id'=>'[0-9]+']);
	Route::post('sanpham/store/{danhmuc_id}',array('as'=>'admin.sanpham.store','uses'=>'SanphamController@store'))->where(['danhmuc_id'=>'[0-9]+']);
	Route::get('sanpham/edit/{danhmuc_id}/{sp_id}',array('as'=>'admin.sanpham.edit','uses'=>'SanphamController@edit'))->where(['danhmuc_id'=>'[0-9]+','sp_id'=>'[0-9]+']);
	Route::post('sanpham/edit/{sp_id}',array('as'=>'admin.sanpham.update','uses'=>'SanphamController@updatesanpham'))->where(['sp_id'=>'[0-9]+']);

	Route::post('sanpham/status',array('as'=>'admin.sanpham.status', 'uses'=>'SanphamController@status'));
	Route::get('sanpham/delete/{id}',array ('as'=>'admin.sanpham.delete', 'uses'=>'SanphamController@delete'))->where('id','[0-9]+');
	Route::post('sanpham/deleteAll',array ('as'=>'admin.sanpham.deleteAll', 'uses'=>'SanphamController@deleteAll'));

	Route::post('sanpham/khuyenmai', array('as'=>'admin.sanpham.khuyenmai','uses'=>'SanphamController@khuyenmai'));
	Route::post('sanpham/order', array('as'=>'admin.sanpham.order','uses'=>'SanphamController@order'));

	// CUSTOMER
	Route::get('customer/delete/{id}',array ('as'=>'admin.customer.delete', 'uses'=>'CustomerController@delete'))->where('id','[0-9]+');
	Route::post('customer/deleteAll',array ('as'=>'admin.customer.deleteAll', 'uses'=>'CustomerController@deleteAll'));
	Route::resource('customer','CustomerController');

	// SUPPORT
	Route::get('support/delete/{id}',array ('as'=>'admin.support.delete', 'uses'=>'SupporterController@delete'))->where('id','[0-9]+');
	Route::post('support/deleteAll',array ('as'=>'admin.support.deleteAll', 'uses'=>'SupporterController@deleteAll'));
	Route::post('support/order',array('as'=>'admin.support.order', 'uses'=>'SupporterController@order'));
	Route::post('support/status',array('as'=>'admin.support.status', 'uses'=>'SupporterController@status'));
	Route::resource('support','SupporterController');
});
View::composer('admin::layouts.sidebar',function($view){
	$danhmuc = \Cache::rememberForever('danhmuc-cache',function(){
		return lienhoa\models\Danhmuc::where('status',1)->orderBy('order','ASC')->get();
	});
	$view->with(compact('danhmuc'));
});

View::composer('admin::layouts.header',function($view){
	// $customer = lienhoa\models\Customer::where('xem',0)->orderBy('id','DESC')->take(5)->get();
	$customer = \Cache::rememberForever('customer',function(){
		return lienhoa\models\Customer::where('xem',0)->orderBy('id','DESC')->take(5)->get();
	});
	$view->with(compact('customer'));
});