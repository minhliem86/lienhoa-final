@extends('admin::layouts.default')

@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h4 class="page-head-line">Create Account</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				{{Form::open(array('route'=>'admin.user.create') )}}
				
				{{Form::label('Email')}}
				{{Form::text('email',Input::old('email'), array('class'=>'form-control') )}}

				{{Form::label('Password')}}
				{{Form::password('password', array('class'=>'form-control') )}}

				{{Form::label('Confirm password')}}
				{{Form::password('password', array('class'=>'form-control') )}}

				{{Form::label('First name')}}
				{{Form::text('first_name',Input::get('first_name') , array('class'=>'form-control') )}}

				{{Form::label('Last name')}}
				{{Form::text('last_name',Input::old('last_name'), array('class'=>'form-control') )}}
				<hr />
				
				{{Form::submit('Create account',array('class'=>'btn btn-info') )}}
				{{Form::close()}}
				{{Notification::showError()}}
				
			</div>
		</div>
	</div>
</div>
@stop