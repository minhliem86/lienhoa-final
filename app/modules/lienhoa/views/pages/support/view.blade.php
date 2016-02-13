@extends('admin::layouts.default')

@section('content')
<section class="content-header">
  <h1>Albums</h1>
</section>
<section class="content">
	<div class="box">
		{{Form::model($supporter,array('route'=>array('admin.support.update',$supporter->id),'method'=>'PUT' ,'class'=>'formAdmin form-horizontal','files'=>true))}}
			<div class="form-margin">
				<label for="name">Name</label>
				{{Form::text('name',Input::old('name'),array('class'=>'form-control'))}}
			</div>
			
			<div class="form-margin">
				<label for="phone">Hot line</label>
				{{Form::text('phone',Input::old('phone'),array('class'=>'form-control'))}}
			</div>
			<div class="form-margin">
				<span class="inline-radio"><input type="radio" name="status" value="1" {{$supporter->status == 1 ? 'checked' : ''}}> <b>Hiện</b> </span>
				<span class="inline-radio"><input type="radio" name="status" value="0"  {{$supporter->status == 0 ? 'checked' : ''}}> <b>Ẩn</b> </span>
			</div>

			<div class="form-margin">
					{{Form::submit('Save',array('class'=>'btn btn-primary'))}}
			</div>
	{{Form::close()}}
	</div>
</section>
@stop

@section('script')
	{{HTML::script('public/backend/js/ckfinder/ckfinder.js')}}
	<!-- ICHECK -->
	{{HTML::style('public/backend/plugins/iCheck/all.css')}}
	{{HTML::script('public/backend/plugins/iCheck/icheck.min.js')}}
	<script>
		$(document).ready(function(){
			$('input[name="status"]').iCheck({
				radioClass: 'iradio_minimal-blue'
			})
		})
		// CONFIG CKFINDER
		function openCKFinder(){
			var finder = new CKFinder();
			finder.basePath = "{{asset('public/upload')}}";	// The path for the installation of CKFinder (default = "/ckfinder/").
			finder.selectActionFunction = ShowFileInfo;
			finder.popup();
		}
		function ShowFileInfo( fileUrl, data, allFiles ){
			if(allFiles.length > 1){
				alertify.error('Please choose only 1 image !');
			}else{
				var div = document.getElementById("preview_img");
				var img = document.createElement("IMG");
				img.id = 'img-pre';
				img.setAttribute('style', 'max-width:200px');
				img.setAttribute('src',fileUrl);
			           div.innerHTML = '';
			           div.appendChild(img);

			           var input = document.createElement('INPUT');
			           input.setAttribute('type','hidden');
			           input.setAttribute('name','file');
			           input.setAttribute('value',fileUrl);
			           div.appendChild(input);
			}
		}
	</script>
@stop