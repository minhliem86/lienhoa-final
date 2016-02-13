<?php
namespace lienhoa\events;

use lienhoa\events\Customer\CustomerEventHandler;
use Illuminate\Support\ServiceProvider;
class EventServiceProvider extends ServiceProvider{
	public function register(){
		$this->app->events->subscribe(new CustomerEventHandler);
	}
}