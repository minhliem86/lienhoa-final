<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 2 | Starter</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	
	{{HTML::style('public/backend/bootstrap/css/bootstrap.min.css')}}

		 <!-- Font Awesome -->
	{{HTML::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css')}}

	<!-- Ionicons -->
	{{HTML::style('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}
	<!-- Theme style -->
	{{HTML::style('public/backend/css/AdminLTE.min.css')}}

	<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
	        page. However, you can choose any other skin. Make sure you
	        apply the skin class to the body tag so the changes take effect.
	  -->
	 {{HTML::style('public/backend/css/skins/skin-blue.min.css')}}

	 <!-- CUSTOMIZE -->
	 {{HTML::style('public/backend/css/style.css')}}

	<!-- Date Picker -->
	{{HTML::style('public/backend/plugins/datepicker/datepicker3.css')}}

	<!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!--
	BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
</head>
<body class="skin-blue sidebar-mini">
	<div class="wrapper">
		<div class="wrap-loading">
			<img src="{{asset('public/backend/img/loading.gif')}}" alt="">
		</div>
		@include('admin::layouts.header')
		@include('admin::layouts.sidebar')
			<div class="content-wrapper">
				@yield('content')
			</div> <!-- end content-wrapper-->

		@include('admin::layouts.footer')
	</div>	<!-- end wrapper-->

	{{HTML::script('public/backend/js/jQuery-2.1.4.min.js')}}
	 <!-- CORE JQUERY SCRIPTS -->
	{{HTML::script('public/backend/bootstrap/js/bootstrap.min.js')}}

	<!-- datepicker -->
	{{HTML::style('public/backend/plugins/datepicker/bootstrap-datepicker.js')}}
	<!-- APP -->
	{{HTML::script('public/backend/js/app.js')}}

	<!-- CKEDITOR + ALERT -->
	{{HTML::script('public/backend/js/ckeditor/ckeditor.js')}}
	{{HTML::script('public/backend/js/alert/alertify.js')}}
	{{HTML::style('public/backend/js/alert/alertify.css')}}
	{{HTML::style('public/backend/js/alert/semantic.min.css')}}
	
	@yield('script')
</body>
</html>