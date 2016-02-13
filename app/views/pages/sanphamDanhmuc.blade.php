@extends('layouts.default')

@section('content')
<div class="content">
	<div class="sanpham-page">
		<div class="each-sanpham">
			<div class="block">
				<h2 class="title-block"><span>{{$danhmuc->title}}</span></h2>
			</div>
			<div class="mot-sp">
				<div class="row">
					@if(!$sanpham->isEmpty())
						@foreach($sanpham as $item_sp)
						<div class="col-md-3 col-sm-3">
							<a href="{{route('user.sanpham.detail',array($danhmuc->slug,$item_sp->slug))}}">
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
					@endif
				</div>
			</div>
		</div>

		<div class="wrap-pagination">
			 {{$sanpham->links()}}
		</div>

	</div>	<!-- sanpham-page-->
</div>	<!-- end content -->
@stop


