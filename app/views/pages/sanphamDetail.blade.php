@extends('layouts.default')

@section('content')
<div class="content">
	<div class="detail-page">
		<div class="block">
			<h2 class="title-block"><span>Sản phẩm </span></h2>
		</div>
		<div class="wrap wrap-chitiet">
			<div class="row">
				<div class="col-md-4 col-sm-5 left-chitiet">
					<img src="{{$sanpham->image_path}}" class="img-responsive" alt="">
				</div>
				<div class="col-md-8 col-sm-7 right-sp">
					<h4 class="title-sp">{{$sanpham->name}}</h4>
					<p><b>Chất liệu:</b> {{$sanpham->chatlieu}}</p>
					<p><b>Kiểu dáng:</b> {{$sanpham->style}}</p>
					<p><b>Size:</b> {{$sanpham->size}}</p>
				</div>
			</div>
		</div>	<!-- end wrap- sp-->
		@if($sanpham->mota !== null)
		<div class=" wrap detail">
			<ul class="nav nav-tabs ">
				<li role="presentation" class="active">Mô tả sản phẩm</li>
			</ul>
			<div class="mota">
				<p>{{$sanpham->mota}}</p>
			</div>
		</div>
		@endif
		<div class=" wrap wrap-relate hidden-xs">
			<div class="block">
				<h2 class="title-block"><span>Sản phẩm cùng loại</span></h2>
			</div>
			<ul class="list-relate">
				@foreach($sp_relate as $item_relate)
				<li><a href="#">
					<div class="wrap-sp">
						<div class="filter"></div>
						<img src="{{$item_relate->image_path}}" class="img-responsive img-sp" alt="Ao So mi Han Quoc">
						<div class="wrap-name">
							<h3 class="name-sp">{{$item_relate->name}}</h3>
						</div>
					</div>	<!-- end wrap-sp-->
				</a></li>
				@endforeach
			</ul>
		</div>
	</div>	<!-- detail-page-->
</div>	<!-- end content -->
@stop
