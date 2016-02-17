<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/',array('as'=>'home','uses'=>'HomeController@index'));
// GIOITHIEU
Route::get('gioithieu',array('as'=>'user.gioithieu', 'uses'=>'GioithieuController@index'));
// LIENHE
Route::get('lienhe',array('as'=>'user.lienhe','uses'=>'LienheController@index'));
Route::post('lienhe',array('before:csrf','as'=>'user.lienhe.post','uses'=>'LienheController@postCustomer'));

//DANHMUC - SAN PAM
Route::get('sanpham',array('as'=>'user.sanpham','uses'=>'SanphamController@sanpham'));
Route::get('sanpham/{slug_danhmuc}',array('as'=>'user.sanpham.danhmuc','uses'=>'SanphamController@danhmuc'))->where(['slug_danhmuc'=>'[a-zA-Z0-9._\-]+']);
Route::get('sanpham/{slug_danhmuc}/{slug_sp}',array('as'=>'user.sanpham.detail','uses'=>'SanphamController@sanphamDetail'))->where(['slug_danhmuc'=>'[a-zA-Z0-9._\-]+','slug_sp'=>'[a-zA-Z0-9._\-]+']);
// TINTUC
Route::get('tintuc',array('as'=>'user.tintuc','uses'=>'TintucController@tintuc'));
Route::get('tintuc/{slug_tintuc}',array('as'=>'user.tintuc.detail','uses'=>'TintucController@tintuc_detail'))->where(['slug_tintuc'=>'[a-zA-Z0-9._\-]+']);

// SERACH
Route::get('search',array('before:csrf','as'=>'user.search','uses'=>'SearchController@search'));


View::composer('layouts.sidebar',function($view){
	$danhmuc = Cache::rememberForever('danhmuc_sidebar',function(){
		return lienhoa\models\Danhmuc::where('status',1)->orderBy('order','ASC')->get();
	});
	$sp_khuyenmai = Cache::rememberForever('sp_khuyenmai',function(){
		return lienhoa\models\Sanpham::where('status',1)->where('khuyenmai',1)->get();
	});
	$support = Cache::rememberForever('support',function(){
		return lienhoa\models\Supporter::where('status',1)->orderBy('order','ASC')->get();
	});

	$view->with(compact('danhmuc','sp_khuyenmai','support'));
	
});
View::composer(array('layouts.footer','layouts.header'),function($view){
	$diachi = Cache::rememberForever('diachi',function(){
		return Contact::first();
	});
	$view->with(compact('diachi'));
});

View::composer('layouts.banner',function($view){
	$banner = Cache::rememberForever('banner',function(){
		return Image::with(array('album'=>function($query){$query->where('slug','banner');}))->get();
	});
	$view->with(compact('banner'));
});


Route::get('404',function(){
	return View::make('errors.404');
});

App::missing(function($exception)
{
    return \View::make('errors.404');
});


