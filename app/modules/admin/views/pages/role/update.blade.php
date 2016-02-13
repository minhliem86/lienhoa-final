@extends('admin::layouts.default')

@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-xs-5">
				{{Form::model($user,array('route'=>array('admin.user.doupdateRole',$user->id),'class'=>'form'))}}
					<div class="form-group">
						<label for="username">Username</label>
						{{Form::text('username',Input::old('username'),array('class'=>'form-control','disabled'=>'disabled') )}}
					</div>
					<div class="form-group">
						<label for="username">Email</label>
						{{Form::text('email',Input::old('email'),array('class'=>'form-control','disabled'=>'disabled') )}}
					</div>
					<div class="form-group">
						<label for="username">Role</label>
							{{Form::text('name_role',$roles->name, array('class'=>'form-control', 'disabled'=>'disabled'))}}
					</div>
					<div class="form-group">
						<label for="username">Permissions</label>
						@foreach($per_list as $k=>$per)
							@if($k < count($pers))
							<p>{{Form::checkbox('name_permission[]',$per->id,$pers[$k]['id'] == $per->id ? true : null)}} {{$per->display_name}}</p>
							@else
							<p>{{Form::checkbox('name_permission[]',$per->id)}} {{$per->display_name}}</p>
							@endif
						@endforeach
					</div>
					<div class="form-group">
						{{Form::submit('Save changes', array('class'=>'btn btn-primary'))}}
					</div>
				{{Form::close()}}
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