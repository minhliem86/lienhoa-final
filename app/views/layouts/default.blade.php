<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="@yield('meta_keywords', 'áo sơ mi, ao so mi, áo hàn quốc, ao han quoc, áo thun, ao thun')"/>
	<meta name="description" content="@yield('meta_des', 'Lien Hoa Fashion chuyên cung cấp sỉ lẻ các loại áo thun, áo sơ mi hàn quốc, quần jean, quần tây với kiểu dáng trẻ trung, sang trọng')">
	<link rel="shortcut icon" href="{{Assets::img('favicon.ico')}}" type="image/x-icon">
	<link rel="icon" href="{{Assets::img('favicon.ico')}}" type="image/x-icon">
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">



	{{HTML::style('public/frontend/css/bootstrap.css')}}
	{{HTML::style('public/frontend/css/bootstrap.css.map')}}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	{{HTML::style('public/frontend/js/scroll/slick.css')}}
	{{HTML::style('public/frontend/js/scroll/slick-theme.css')}}
	{{HTML::style('public/frontend/js/nivo/nivo-slider.css')}}
	{{HTML::style('public/frontend/js/nivo/themes/light/light.css')}}
	{{HTML::style('public/frontend/css/style.css')}}

	{{HTML::script('public/frontend/js/jquery-1.11.2.min.js')}}
	{{HTML::script('public/frontend/js/bootstrap.min.js')}}
	{{HTML::script('public/frontend/js/scroll/slick.js')}}
	{{HTML::script('public/frontend/js/nivo/jquery.nivo.slider.js')}}
	<title>Lien Hoa Fashion</title>
</head>
<body class="xanh">
	<div class="bg">
		<div class="page">
			<div class="container">
				<div class="row">
					@include('layouts.header')
					<section class="body">

						@include('layouts.banner')
						<section class="content-area">
							<div class="row">
								
								<div class="col-sm-8 col-md-9 col-sm-push-4 col-md-push-3 col-lg-9 col-lg-push-3">
									@yield('content')
								</div>
								<div class="col-sm-4 col-md-3 col-sm-pull-8 col-md-pull-9 col-lg-3 col-lg-pull-9">
									@include('layouts.sidebar')
								</div>
							</div>
						</section>
					</section>
				</div>
			</div>
			@include('layouts.footer')
		</div> <!-- end page -->
	</div> <!-- end bg -->

	@yield('script')
	<script type="text/javascript">
	$(document).ready(function(){
		$('.wrap-scroll').slick({
			  infinite: true,
			  speed: 800,
			  fade: true,
			  cssEase: 'linear',
			  autoplay:true
		})
		$(".list-relate").slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
		})
		 $("#slider-nivo").nivoSlider({
		 	directionNav: false,
    			controlNav: false,
		 })

	})
	</script>
</body>
</html>