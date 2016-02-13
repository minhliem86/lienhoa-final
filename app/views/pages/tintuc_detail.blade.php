@extends('layouts.default')

@section('content')
<div class="content">
	<div class="tintuc-page">
		<div class="block">
			<h2 class="title-block"><span>{{$tintuc->title}}</span></h2>
			<div class="wrap-tintuc">
				{{$tintuc->content}}
			</div>

			<div class="relate">
				<p class="not">Các tin khác</p>
				<ul>
					@foreach($relate as $item_relate)
					<li><a href="{{route('user.tintuc.detail',$item_relate->slug)}}">{{$item_relate->title}}</a></li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>	<!-- end tintuc-page-->
</div>	<!-- end content -->
@stop
