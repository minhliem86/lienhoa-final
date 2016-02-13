@extends('admin::layouts.default')

@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-5">
				<h4 class="page-head-line">Add New</h4>
				<!-- <form action="" method="post" class="formAddCate"> -->
				{{Form::open(array('route'=>'admin.category.store', 'class'=>'formAddCate') )}}
					<div class="form-group">
						<label for="title">Title Categrory</label>
						{{Form::text('title',Input::old('title'),array('class'=>'form-control') )}}
						<span class="error">{{$errors->first('title')}}</span>
					</div>
					@if($list != null)
					<div class="form-group">
						<label for="title">Parent</label>
						{{Form::select('parent_id', array(" "=> 'select parent') + $list, '0', array('class'=>'form-control') )}}
					</div>
					@endif
					<div class="form-group form-submit">
						<input type="submit" value="Apply" class="btn btn-primary pull-right">
					</div>
					
				{{Form::close()}}
			</div>
			<div class="col-sm-7">
				<h4 class="page-head-line">Categrories</h4>
				@if($cate != null )
				
					<table class="table table-striped  table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Status</th>
								<th>Parent</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($cate as $item)
							<tr>
								<td></td>
								<td>{{$item->title}}</td>
								<td width="120px">
								<button class="btn btn-warning loading"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
								{{Form::select('show', array('0'=>'hide', '1'=>'show'), $item->show, array('class'=>'form-control', 'id'=>$item->id ) )}}</td>
								<td> {{ ($item->parent_id != null ? Category::find($item->parent_id)->title : "--" )}}</td>
								<td><a href="{{URL::route('admin.category.edit',$item->id)}}" class="btn btn-info"> Edit </a>  <a href="{{URL::route('admin.category.delete',$item->id)}}" class="btn btn-danger"> Remove </a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				
				@else
				<h4>No Data</h4>
				@endif

			</div>
		</div>
	</div>
</div>
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			{{Notification::showSuccess('alertify.log(":message");') }}

			// SHOW/HIDE
			$('.loading').hide();
			$('select[name="show"]').change(function(){
				var id = $(this).attr('id');
				var val = $(this).val();
				var a = $(this);
				$.ajax({
					'url' : "{{route('admin.category.status')}}",
					'type' : 'POST',
					'data' : {id:id, value : val},
					'beforeSend':function(){
						a.prev().fadeIn();
						a.hide();
					},
					'success': function(){
						a.prev().fadeOut('fast');
						a.fadeIn('slow');
					},

				})

			})
		});


	</script>
@stop