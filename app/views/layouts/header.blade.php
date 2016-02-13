 	<header>
	<section class="logo clearfix">
		<a href="{{URL::to('/')}}" class="logo-link"><img src="{{Assets::img('logo.png')}}" height="120" width="120" alt="Lienhoafashion"></a>
		<div class="right-header">
			<div class="diachi">
				<p><i class="fa fa-home"></i> {{$diachi->address}}</p>
				<p><i class="fa fa-envelope"></i> {{$diachi->email}}</p>
			</div>	<!-- end diachi -->

		</div>	<!-- left-header-->
	</section>
	<nav>
		<div class="navigation-bar ">
			<div class="navbar-header">
				<button type="button" class="search-btn collapsed navbar-toggle" data-toggle="collapse" data-target="#collape-search" aria-expanded="false">
					<i  class="fa fa-search"></i>
				</button>
				<!-- <span class="navbar-brand visible-xs">Menu</span> -->
				
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collape-menu" aria-expanded="false">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="collape-menu">
				<ul class="main-menu">
					<li class="{{Active::setActive('1','/')}}"><a href="{{url('/')}}">Trang Chủ</a></li>
					<li class="{{Active::setActive('1','gioithieu')}}" ><a href="{{route('user.gioithieu')}}">Giới Thiệu</a></li>
					<li class="{{Active::setActive('1','sanpham')}}"><a href="{{route('user.sanpham')}}">Sản Phẩm</a></li>
					<li class="{{Active::setActive('1','tintuc')}}"><a href="{{route('user.tintuc')}}">Tin Tức</a></li>
					<li class="{{Active::setActive('1','lienhe')}}"><a href="{{route('user.lienhe')}}">Liên Hệ</a></li>

				</ul>
			</div>
		</div>
		<div class="wrap-formSearch collapse " id="collape-search">
			{{Form::open(array('route'=>'user.search', 'id'=>'search-form','method'=>'GET'))}}
				<div class="input-group">
					<input type="text" class="form-control" name="key" />
					<span class="input-group-addon">
						<i class="fa fa-search"></i>
					</span>
				</div>
			{{Form::close()}}
		</div>
		
	</nav>
</header>