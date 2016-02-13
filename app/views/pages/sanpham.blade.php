@extends('layouts.default')

@section('content')
<div class="content">
	<div class="sanpham-page">
		@if(!$danhmuc->isEmpty())
			@foreach($danhmuc as $item_dm)
			<div class="each-sanpham">
				<div class="block">
					<h2 class="title-block"><span>{{$item_dm->title}}</span></h2>
					<span class="all"><a href="{{route('user.sanpham.danhmuc',$item_dm->slug)}}">Xem tất cả</a></span>
				</div>
				<div class="mot-sp">
					<div class="row">
						@foreach($item_dm->sanpham()->where('status',1)->orderByRaw('RAND()')->take(8)->get() as $item_sp)
						<div class="col-md-3 col-sm-3">
							<a href="{{route('user.sanpham.detail',array($item_dm->slug,$item_sp->slug))}}">
								<div class="wrap-sp">
									<div class="filter"></div>
									<img src="{{$item_sp->image_path}}" class="img-responsive img-sp" alt="Ao So mi Han Quoc">
									<div class="wrap-name">
										<h3 class="name-sp">{{$item_sp->name}}</h3>
										<p class="mota">{{Str::words($item_sp->chatlieu,10)}}</p>
									</div>
								</div>	<!-- end wrap-sp-->
							</a>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			@endforeach
		@endif
		
	</div>	<!-- sanpham-page-->
</div>	<!-- end content -->
@stop
