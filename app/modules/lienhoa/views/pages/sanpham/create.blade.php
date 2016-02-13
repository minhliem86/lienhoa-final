@extends('admin::layouts.default')

@section('content')
<section class="content-header">
  <h1>Danh mục Sản Phẩm: {{$danhmuc->title}}</h1>
</section>
<section class="content">
	<div class="box">
		{{Form::open(array('route'=>array('admin.sanpham.store',$danhmuc_id),'class'=>'formAdmin form-horizontal','files'=>true))}}
			<div class="form-margin">
				<label for="name">Tên sản phẩm</label>
				{{Form::text('name',Input::old('name'),array('class'=>'form-control'))}}
			</div>
			<div class="form-margin">
				<label for="chatlieu">Chất liệu sản phẩm</label>
				{{Form::textarea('chatlieu',Input::old('chatlieu'),array('class'=>'form-control','rows'=>3))}}
			</div>
			<div class="form-margin">
				<label for="mausac">Màu sắc sản phẩm</label>
				{{Form::textarea('mausac',Input::old('mausac'),array('class'=>'form-control','rows'=>3))}}
			</div>
			<div class="form-margin">
				<label for="size">Size sản phẩm</label>
				{{Form::textarea('size',Input::old('size'),array('class'=>'form-control','rows'=>3))}}
			</div>
			<div class="form-margin">
				<label for="style">Kiểu dáng sản phẩm</label>
				{{Form::textarea('style',Input::old('style'),array('class'=>'form-control','rows'=>3))}}
			</div>
			
			<div class="form-margin">
				<label for="mota">Mô tả sản phẩm</label>
				{{Form::textarea('mota',Input::old('mota'),array('class'=>'form-control ckeditor'))}}
			</div>
			<div class="form-margin">
				<label for="img">Hình ảnh đại diện</label>
				<button type="button" id="open_img" class="btn btn-primary" onclick="openCKFinder()">Choose images</button>
				<div id="preview_img"></div>
			</div>

			<div class="form-margin">
				<p><label for="status">Trạng thái</label></p>
				<span class="inline-radio"><input type="radio" class="style" name="status" value="1" checked=""> <b>Hiện</b> </span>
				<span class="inline-radio"><input type="radio" class="style" name="status" value="0" > <b>Ẩn</b> </span>
			</div>
			<div class="form-margin">
				<p><label for="khuyenmai">Sản phẩm khuyến mãi</label></p>
				<span class="inline-radio"><input type="radio" class="style" name="khuyenmai" value="1" checked=""> <b>Có</b> </span>
				<span class="inline-radio"><input type="radio" class="style" name="khuyenmai" value="0" > <b>Không</b> </span>
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
			$('input.style').iCheck({
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