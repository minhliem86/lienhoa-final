@extends('layouts.default')

@section('content')
<div class="content">
	<div class="tintuc-page">
		<div class="block">
			<h2 class="title-block"><span>Tin Tức</span></h2>
			@if(!is_null($tintuc))
				@foreach($tintuc as $item_tintuc)
				<div class="each-tintuc">
					<div class="row">
						<div class="col-md-2 col-sm-3">
							<a href="{{route('user.tintuc.detail',$item_tintuc->slug)}}"><img src="{{$item_tintuc->image_path}}" class="img-responsive img-tintuc" alt="{{$item_tintuc->image_name}}" title="{{$item_tintuc->image_name}}"></a>
						</div>
						<div class="col-md-10 col-sm-9">
							<h3 class="title-tintuc">{{$item_tintuc->title}}</h3>
							<p class="time"><small>{{\Carbon\Carbon::createFromTimeStamp(strtotime($item_tintuc->created_at))->format('d-m-Y')}}</small></p>
							<p>{{Str::words($item_tintuc->content,30)}}</p>
							<p class="readmore"><a href="{{route('user.tintuc.detail',$item_tintuc->slug)}}">Read more...</a></p>
						</div>
					</div>
				</div>	<!-- end each-tintuc-->
				@endforeach
				<div class="wrap-paginate pull-right">
					{{$tintuc->links()}}
				</div>
			@endif
		</div>
	</div>	<!-- end tintuc-page-->
</div>	<!-- end content -->
@stop
