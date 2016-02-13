<?php
namespace services\ServiceProvider;

use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider{
	public function register(){
		$this->app->bind('services\Contact\RepoInterface','services\Contact\Eloquent');
		$this->app->bind('services\User\RepoInterface','services\User\Eloquent');
		$this->app->bind('services\Album\RepoInterface','services\Album\Eloquent');
		$this->app->bind('services\Image\RepoInterface','services\Image\Eloquent');
		$this->app->bind('services\Group\RepoInterface','services\Group\Eloquent');
		$this->app->bind('services\Categories\RepoInterface','services\Categories\Eloquent');
		$this->app->bind('services\Post\RepoInterface','services\Post\Eloquent');
		$this->app->bind('services\PostAddition\RepoInterface','services\PostAddition\Eloquent');
		$this->app->bind('services\Role\RepoInterface','services\Role\Eloquent');
		$this->app->bind('services\Permission\RepoInterface','services\Permission\Eloquent');
		// LIENHOA
		$this->app->bind('lienhoa\services\news\RepoInterface','lienhoa\services\news\Eloquent');
		$this->app->bind('lienhoa\services\gioithieu\RepoInterface','lienhoa\services\gioithieu\Eloquent');
		$this->app->bind('lienhoa\services\danhmuc\RepoInterface','lienhoa\services\danhmuc\Eloquent');
		$this->app->bind('lienhoa\services\sanpham\RepoInterface','lienhoa\services\sanpham\Eloquent');
		$this->app->bind('lienhoa\services\customer\RepoInterface','lienhoa\services\customer\Eloquent');
		$this->app->bind('lienhoa\services\support\RepoInterface','lienhoa\services\support\Eloquent');

		// FRONTEND
		$this->app->bind('services\frontend\RepoInterface','services\frontend\Eloquent');
	}
}