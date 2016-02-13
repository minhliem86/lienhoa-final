@extends('admin::layouts.default')

@section('content')
<section class="content-header">
  <h1>Tin tức</h1>
</section>
<section class="content">
	<div class="box">
		{{Form::open(array('route'=>'admin.danhmuc.store','class'=>'formAdmin form-horizontal','files'=>true))}}
			<div class="form-margin">
				<label for="title">Tên danh mục sản phẩm</label>
				{{Form::text('title',Input::old('title'),array('class'=>'form-control'))}}
			</div>
			
			<div class="form-margin">
				<label for="mota">Mô tả danh mục</label>
				{{Form::textarea('mota',Input::old('mota'),array('class'=>'form-control'))}}
			</div>
			<div class="form-margin">
				<label for="img">Hình ảnh đại diện</label>
				<button type="button" id="open_img" class="btn btn-primary" onclick="openCKFinder()">Choose images</button>
				<div id="preview_img"></div>
			</div>
			<div class="form-margin">
				<span class="inline-radio"><input type="radio" name="status" value="1" checked=""> <b>Hiện</b> </span>
				<span class="inline-radio"><input type="radio" name="status" value="0" > <b>Ẩn</b> </span>
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
					img.setAttribute('class', 'img-responsive');
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