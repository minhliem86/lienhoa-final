<section class="banner">
	<div class="wrap-banner">
		<div class="slider-wrapper theme-light">
			<div id="slider-nivo" class="nivoSlider">
				@foreach($banner as $item)
					<img src="{{asset($item->path_img)}}" alt="image01" />
				@endforeach
			</div>
		</div>
	</div>
</section>	<!-- end banner -->