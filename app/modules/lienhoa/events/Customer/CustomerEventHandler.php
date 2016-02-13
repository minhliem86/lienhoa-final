<?php
namespace lienhoa\events\Customer;

use lienhoa\models\Customer;
class CustomerEventHandler{
	public function handle($customer,$email){
		\Mail::send('emails.remind',['data'=>$customer],function($message) use ($customer,$email){
			$message->to($email->email,'CP PANEL')->subject('Liên Hoa Fashion - Yêu cầu của khách hàng');
		});
	}

	public function subscribe($events){
		$events->listen('customer.dangki','lienhoa\events\Customer\CustomerEventHandler');
	}
}