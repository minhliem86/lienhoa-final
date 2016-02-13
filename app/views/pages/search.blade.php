@extends('layouts.default')

@section('content')
<div class="content">
	<div class="tintuc-page">
		<div class="block">
			<h2 class="title-block"><span>Tin Tức</span></h2>
			@if(!$result->isEmpty())
				@foreach($result as $item)

				<div class="each-tintuc">
					<div class="row">
						<div class="col-md-2 col-sm-3">
							<a href="{{route('user.sanpham.detail',array(lienhoa\models\Danhmuc::find($item->danhmuc_id)->slug,$item->slug))}}"><img src="{{$item->image_path}}" class="img-responsive img-tintuc" alt="{{$item->image_name}}" title="{{$item->image_name}}"></a>
						</div>
						<div class="col-md-10 col-sm-9">
							<h3 class="title-tintuc">{{$item->name}}</h3>
							<p>{{Str::words($item->mota,30)}}</p>
							<p class="readmore"><a href="{{route('user.sanpham.detail',array(lienhoa\models\Danhmuc::find($item->danhmuc_id)->slug,$item->slug))}}">Read more...</a></p>
						</div>
					</div>
				</div>	<!-- end each-tintuc-->
				@endforeach
				<div class="wrap-paginate pull-right">
					{{$result->appends(array('key'=>$keyword))->links() }}
				</div>
			@else
				<h4>Không có kết quả tìm kiếm với từ khóa : <b><big>{{$keyword}}</big></b></h4>
			@endif
		</div>
	</div>	<!-- end tintuc-page-->
</div>	<!-- end content -->
@stop
