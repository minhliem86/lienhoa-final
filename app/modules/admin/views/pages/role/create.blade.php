@extends('admin::layouts.default')
@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="panel panel-info">
				<div class="panel-heading">Roles</div>
				<div class="panel-body">
					<div class="wrap-ul-role">
						<ul class="nav-role">
							@foreach($role as $item)
							<li>{{$item->name}}</li>
							@endforeach
						</ul>
					</div>
					{{Form::open(array('route'=>'admin.user.createRole'))}}
						<div class="form-group">
							<label for="name_role">Role Name</label>
							{{Form::text('name_role',Input::old('name'),array('class'=>'form-control') )}}
							<span>{{$errors->first('name_role')}}</span>
						</div>
						<div class="form-group">
							<label for="name_per">Select Permission (Press CTRL then click to choose multiple)</label>
							{{Form::select('name_per[]', array('login'=> 'Access Dashboard ','UserManager' => ' User Manager', 'HRManager'=>'HR Manager', 'ILACNManager' => 'ILA CN Manager', 'BenConner'=> "Ben's Conner"),'login',array('class'=>'form-control','multiple'=>'multiple' ))}}
							<span>{{$errors->first('name_per')}}</span>
						</div>
						<div class="form-group">
							{{Form::submit('Save', array('class'=>'btn btn-primary'))}}
						</div>
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('script')
	{{HTML::script('public/backend/assets/js/table-bootstrap/bootstrap-table.js')}}
	{{HTML::style('public/backend/assets/js/table-bootstrap/bootstrap-table.css')}}

	<script type="text/javascript">
		$(document).ready(function(){
			{{Notification::showSuccess('alertify.success(":message");') }}
			{{Notification::showError('alertify.error(":message");') }}

		});
	</script>
@stop