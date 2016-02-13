@extends('admin::layouts.default')

@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-5">
				<h4 class="page-head-line">Edit Category</h4>
				{{Form::model($cate, array('route'=>array('admin.category.update', $cate->id), 'method'=>'PUT') )}}
					<div class="form-group">
						<label for="title">Title Categrory</label>
						{{Form::text('title', Input::old('title'), array('class'=>'form-control'))}}
					</div>
					<div class="form-group">
						<label for="title">Parent</label>
						{{Form::select('parent_id', array('0' => 'select parent') + $list,Input::old('parent_id'), array('class'=>'form-control') )}}
					</div>
					<div class="form-group">
						<label for="show">Show</label>
						{{Form::select('show',array('0'=>'hide', '1'=>'show') , Input::old('show'), array('class'=>'form-control'))}}
					</div>
					
					<div class="form-group">
						<label for="title">Sort</label>
						{{Form::text('sort', Input::old('sort'), array('class'=>'form-control'))}}
					</div>
					<div class="form-group form-submit">
						{{Form::submit('Apply', array('class'=>'btn btn-primary pull-right'))}}
					</div>
				{{Form::close()}}
			</div>
			
		</div>
	</div>
</div>
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			{{Notification::showSuccess('alertify.log(":message");') }}
		})
	</script>
@stop