@extends('layouts.default')

@section('content')
<div class="content">
	<!-- SP MOI NHAT -->
	<div class="block sp-moinhat">
		<h2 class="title-block"><span>Sản Phẩm mới nhất</span></h2>
		<div class="content-block">
			<div class="row">
				@if(!is_null($sp_moinhat))
				@foreach($sp_moinhat as $item_moi)
				<div class="col-md-3 col-sm-3 col-xs-6">
					<a href="{{route('user.sanpham.detail',array(lienhoa\models\Danhmuc::find($item_moi->danhmuc_id)->slug,$item_moi->slug))}}">
						<div class="wrap-sp">
							<div class="filter"></div>
							<img  src="{{$item_moi->image_path}}" class="img-responsive img-sp" alt="Ao So mi Han Quoc">
							<div class="wrap-name">
								<h3 class="name-sp">{{$item_moi->name}}</h3>
								<p class="mota">{{Str::words($item_moi->chatlieu,5)}}</p>
							</div>
						</div>	<!-- end wrap-sp-->
					</a>
				</div>
				@endforeach
				@endif
				
			</div>
		</div>	<!-- end content block -->
	</div>	<!-- end block-->

	<!-- SP XEMNHIEU -->
	<div class="block sp-xemnhieu">
		<h2 class="title-block"><span>Sản Phẩm Được Quan tâm nhiều nhất</span></h2>
		<div class="content-block">
			<div class="row">
				@if(!is_null($sp_xemnhieu))
				@foreach($sp_xemnhieu as $item_xemnhieu)
				<div class="col-md-3 col-sm-3 col-xs-6">
					<a href="{{route('user.sanpham.detail',array(lienhoa\models\Danhmuc::find($item_xemnhieu->danhmuc_id)->slug,$item_xemnhieu->slug))}}">
						<div class="wrap-sp">
							<div class="filter"></div>
							<img  src="{{$item_xemnhieu->image_path}}" class="img-responsive img-sp" alt="Ao So mi Han Quoc">
							<div class="wrap-name">
								<h3 class="name-sp">{{$item_xemnhieu->name}}</h3>
								<p class="mota">{{Str::words($item_xemnhieu->chatlieu,5)}}</p>
							</div>
						</div>	<!-- end wrap-sp-->
					</a>
				</div>
				@endforeach
				@endif
			</div>
		</div>	<!-- end content block -->
	</div>	<!-- end block-->
</div>	<!-- end content -->
@stop

@section('script')

@stop