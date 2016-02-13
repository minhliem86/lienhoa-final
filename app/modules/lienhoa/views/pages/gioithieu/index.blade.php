@extends('admin::layouts.default')
@section('content')
<section class="content-header">
  <h1>Giới thiệu</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				@if(count($gioithieu) == 0)
					{{Form::open(array('route'=>'admin.gioithieu.index', 'class'=>'formAdmin form-horizontal') )}}
						<div class="form-margin">
							{{Form::label('Bài viết giới thiệu')}}
							{{Form::textarea('content',Input::old('content'),array('class'=>'form-control ckeditor'))}}
						</div>
						<div class="form-margin">
							{{Form::label('Trạng thái')}}
							<div>
								<span class="inline-radio"><input type="radio" name="status" value="1" checked=""> <b>Hiện</b> </span>
								<span class="inline-radio"><input type="radio" name="status" value="0" > <b>Ẩn</b> </span>
							</div>
						</div>
						<div class="form-margin">
							{{Form::submit('Save',array('class'=>'btn btn-primary'))}}
						</div>
					{{Form::close()}}
				@else
					{{Form::model($gioithieu,array('route'=>'admin.gioithieu.index', 'class'=>'formAdmin form-horizontal'))}}
						<div class="form-margin">
							{{Form::label('Bài viết giới thiệu')}}
							{{Form::textarea('content',Input::old('content'),array('class'=>'form-control ckeditor'))}}
						</div>
						<div class="form-margin">
							{{Form::label('Trạng thái')}}
							<div>
								<span class="inline-radio"><input type="radio" name="status" value="1" {{$gioithieu->status == 1 ? 'checked' : ''}}> <b>Hiện</b> </span>
								<span class="inline-radio"><input type="radio" name="status" value="0"  {{$gioithieu->status == 0 ? 'checked' : ''}}> <b>Ẩn</b> </span>
							</div>
						</div>
						<div class="form-margin">
							{{Form::submit('Save',array('class'=>'btn btn-primary'))}}
						</div>
					{{Form::close()}}
				@endif
			</div>
		</div>
	</div>
</section>
@stop

@section('script')
	<!-- SCRIPT -->
	{{HTML::script('public/backend/js/ckfinder/ckfinder.js')}}
	<!-- ICHECK -->
	{{HTML::style('public/backend/plugins/iCheck/all.css')}}
	{{HTML::script('public/backend/plugins/iCheck/icheck.min.js')}}

	<script type="text/javascript">
		$('input[name="status"]').iCheck({
			radioClass: 'iradio_minimal-blue'
		})
	</script>

@stop