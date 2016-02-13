@extends('admin::layouts.default')

@section('content')
<section class="content-header">
  <h1>Albums</h1>
</section>
<section class="content">
	<div class="box">
		{{Form::model($album,array('route'=>array('admin.album.update',$album->id),'method'=>'PUT' ,'class'=>'formAdmin form-horizontal','files'=>true))}}
			<div class="form-group">
				<label for="" class="col-sm-2">Title</label>
				<div class="col-sm-10">
					{{Form::text('title',Input::old('title'),array('class'=>'form-control'))}}
				</div>
			</div>
			@if($album->id !=1)
			<div class="form-group">
				<label for="" class="col-sm-2">Sort</label>
				<div class="col-xs-2">
					{{Form::text('sort',Input::old('sort'),array('class'=>'form-control'))}}
				</div>
			</div>
			@endif
			<div class="form-group">
				<label for="" class="col-sm-2">Show</label>
				<div class="col-xs-2">
					{{Form::select('show',array('0'=>'hide', '1'=>'show'), \Input::get('show'), array('class'=>'form-control') )}}
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					{{Form::submit('Save',array('class'=>'btn btn-primary'))}}
				</div>
			</div>
	{{Form::close()}}
	</div>
</section>
@stop

@section('script')
<script>

</script>
@stop