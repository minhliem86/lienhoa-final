<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	{{HTML::style('public/frontend/css/bootstrap.css')}}
	{{HTML::style('public/frontend/css/bootstrap.css.map')}}
	<title>404 PAGE</title>
	<style>
		html, body{width: 100%; height:100%;}
		div.bg{height: 100vh; width: 100vw}
		img{margin:0 auto;}
		.wrap-404{padding-top:10%;}
		.wrap-404 > div{margin-bottom:20px; }
		.wrap-404 h4{font-size: 30px;}
		.wrap-404 p a{font-size: 22px; color:#000;}
	</style>
</head>
<body>
	<div class="bg" style="background-image:url({{asset('public/backend/img/404/pattern.jpg')}}); ">
		<div class="page">
			<div class="wrap-404">
				<div><img src="{{asset('public/backend/img/404/404.png')}}" alt="404" class="img-responsive" /></div>
				<h4 class="text-center">Chúng tôi rất lấy làm tiếc vì trang bạn đang tìm kiếm không tồn tại!</h4>
				<p class="text-center"><a href="{{url('/')}}">Trở về trang chủ!</a></p>
			</div>
		</div>
	</div>
</body>
</html>