@extends('layouts.default')

@section('content')
<div class="content">
	<div class="gioithieu-page">
		<div class="block">
			<h2 class="title-block"><span>Về chúng tôi</span></h2>
		</div>
		<div class="wrap">
			@if(!empty(Cache::get('gioithieu_cache')))
			{{$gioithieu->content}}
			@endif
		</div>
	</div>	<!-- gioithieu-page-->
</div>	<!-- end content -->
@stop
