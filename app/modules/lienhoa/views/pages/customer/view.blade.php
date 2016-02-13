@extends('admin::layouts.default')

@section('content')
<section class="content-header">
  <h1>Danh sách khách hàng</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">
			<div class="pull-right">
				<a class="btn btn-danger btn-xs" data-method="remove" id="btn-remove" href="{{route('admin.customer.delete',$customer->id)}}">Remove</a>
			</div>
	            </div>
		<div class="form-margin">
			<label for="">Họ tên khách hàng</label>
			<p>{{$customer->fullname}}</p>
		</div>
		<div class="form-margin">
			<label for="">Điện thoại</label>
			<p>{{$customer->phone}}</p>
		</div>
		<div class="form-margin">
			<label for="">Email</label>
			<p>{{$customer->email}}</p>
		</div>
		<div class="form-margin">
			<label for="">Tên công ty</label>
			<p>{{$customer->company_name}}</p>
		</div>
		<div class="form-margin">
			<label for="">Nội dung</label>
			<p>{{$customer->messages}}</p>
		</div>
	</div>
</section>
@stop

@section('script')
@stop