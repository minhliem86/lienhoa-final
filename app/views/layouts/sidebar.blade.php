<div class="sidebar">
	<div class="box clearfix">
		<div class="top-box">
			<h3 class="title-box">Danh Mục Sản Phẩm</h3>
		</div>
		<div class="content-box">
			<ul class="list-danhmuc">
				@if(!empty(Cache::get('danhmuc_sidebar')))
					@foreach($danhmuc as $item_danhmuc)
					<li class="{{Active::setActive('2',$item_danhmuc->slug)}}"><a href="{{route('user.sanpham.danhmuc',$item_danhmuc->slug)}}"><i class="fa fa-angle-double-right"></i> {{$item_danhmuc->title}} </a></li>
					@endforeach
				@endif
			</ul>
		</div>
	</div>	<!--end box -->

	<div class="box">
		<div class="top-box">
			<h3 class="title-box">Hỗ Trợ khách hàng</h3>
		</div>
		<div class="content-box">
			<div class="wrap-hotro">
				@if(!empty(Cache::get('support')))
					@foreach($support as $item_sup)
					<div class="block-hotro">
						<p><i class="fa fa-user"></i> {{$item_sup->name}}</p>
						<p class="phone">{{$item_sup->phone}}</p>
					</div>
					@endforeach
				@endif
			</div>	<!-- end hotro -->
		</div>
	</div>	<!--end box -->

	<div class="box">
		<div class="top-box">
			<h3 class="title-box">Thông tin khuyến mãi</h3>
		</div>
		<div class="content-box">
			<div class="wrap-scroll">
				@if(!empty(Cache::get('sp_khuyenmai')))
				@foreach($sp_khuyenmai as $item_km)
					<div class="wrap-khuyenmai">
						<i class="ic-hot"><img src="{{Assets::img('ic-hot.png')}}" class="img-responsive"></i>
						<a href="{{route('user.sanpham.detail',array(lienhoa\models\Danhmuc::find($item_km->danhmuc_id)->slug,$item_km->slug))}}"><img src="{{$item_km->image_path}}" class="img-responsive" alt=""></a>
					</div>	<!-- end wrap-khuyenmai-->
				@endforeach
				@endif
			</div>
			
		</div>
	</div>	<!--end box -->
</div>	<!-- end sidebar -->