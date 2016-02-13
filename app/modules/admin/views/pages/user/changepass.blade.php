@extends('admin::layouts.default')

@section('content')
<section class="content-header">
  <h1>Change Password</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				{{Form::open(array('route'=>'admin.user.dochangePass') )}}
				<div class="form-group">
					{{Form::password('password',array('class'=>'form-control', 'placeholder' => 'Enter your password') )}}
					<span class="error" style="color:red">{{$errors->first('password')}}</span>	
				</div>
				<div class="form-group">
					{{Form::password('newpassword',array('class'=>'form-control', 'placeholder' => 'Enter your new password') )}}	
					<span class="error" style="color:red">{{$errors->first('newpassword')}}</span>	
				</div>
				<div class="form-group">
					{{Form::password('confirm_pass',array('class'=>'form-control', 'placeholder' => 'Enter your new password again') )}}	
					<span class="error" style="color:red">{{$errors->first('confirm_pass')}}</span>	
				</div>
				<div class="form-group">
					{{Form::submit('Saves changes',array('class'=>'btn btn-info') )}}	
				</div>
				
				{{Form::close()}}
				{{Notification::showError()}}
			</div>
		</div>
	</div>
</section>

@stop