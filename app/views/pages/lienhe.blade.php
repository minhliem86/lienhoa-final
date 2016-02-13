@extends('layouts.default')

@section('content')
<div class="content">
	<div class="lienhe-page">
		<div class="block">
			<h2 class="title-block"><span>Liên hệ </span></h2>
			<div class="wrap-lienhe">

				<div class="row">
					<div class="col-md-6 col-sm-5">
						<div class="wrap-form">
							{{Form::open(array('route'=>'user.lienhe.post','id'=>'form-lienhe') )}}
								<p class="note">Vui lòng điền đầy đủ thông tin bên dưới</p>
								<div class="form-group">
									{{Form::text('fullname',Input::old('fullname'),array('class'=>'form-control', 'placeholder'=>'Họ và tên(*)'))}}
								</div>
								<div class="form-group">
									{{Form::text('email',Input::old('email'),array('class'=>'form-control', 'placeholder'=>'Email(*)'))}}
								</div>
								<div class="form-group">
									{{Form::text('phone',Input::old('phone'),array('class'=>'form-control', 'placeholder'=>'Số điện thoại(*)'))}}
								</div>
								<div class="form-group">
									{{Form::text('company_name',Input::old('company_name'),array('class'=>'form-control', 'placeholder'=>'Tên công ty'))}}
								</div>
								<div class="form-group">
									{{Form::textarea('message',Input::old('message'),array('class'=>'form-control', 'placeholder'=>'Nội dung'))}}
								</div>
								<div class="form-group text-right">
									<input type="submit" class="btn btn-primary" value="Gửi yêu cầu">
								</div>
							{{Form::close()}}
						</div>
						@if(!empty($errors->all()))
						<div class="alert alert-danger" role="alert">

								@foreach($errors->all() as $er)
									<ul class="list-error" style="list-style-type:disc; padding-left:15px;">
										<li>{{$er}}</li>
									</ul>
								@endforeach

						</div>
						@endif
					</div>
					<div class="col-md-6 col-sm-7">
						<div class="info">
							<h4>Công ty TNHH Lien Hoa</h4>
							<p><i class="fa fa-home"> {{$contact->address}}</i></p>
							<p><i class="fa fa-phone"> {{$contact->phone}}</i></p>
							<p><i class="fa fa-envelope"> {{$contact->email}}</i></p>
						</div>
						<!-- <div class="share">
							<span><a href=""><i class="fa fa-facebook-square"></i></a> <a href="#"><i class="fa fa-google-plus-square"></i></a></span>
						</div> -->
						<div class="wrap-map" id="map">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	<!-- end tintuc-page-->
</div>	<!-- end content -->
@stop

@section('script')
	  <script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
	{{HTML::script('public/frontend/js/jquery.validate.min.js')}}
	<script>
	$(document).ready(function(){
		$("#form-lienhe").validate({
			errorElement:'span',
			errorClass: 'invalid',
			rules:{
				'fullname':'required',
				'email':{
					required: true,
					email: true
				},
				'phone':'required'
			},
			messages: {
				'fullname': 'Vui lòng điền Họ và tên',
				'email':{
					'required': 'Vui lòng điền email của qúy khách',
					'email': 'Vui lòng điền định dạng email: ...@...'
				},
				'phone':'Vui lòng điền số điện thoại'
			}
		})
	})
	// MAP
	function initMap() {
	  // Create a map object and specify the DOM element for display.
	  	var map = document.getElementById('map');
	  	var vitri = {lat: {{$map[0]}}, lng: {{$map[1]}}}
	  	var map = new google.maps.Map(map, {
		    center: vitri,
		    scrollwheel: true,
		    zoom: 16
		});
		var marker = new google.maps.Marker({
			position: vitri,
			map: map,
			title: '{{$contact->address}}'
		});
	}
	</script>
@stop
