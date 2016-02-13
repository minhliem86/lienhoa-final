@extends('admin::layouts.default')

@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="wrap-btn">
				@if(Auth::user()->can('usermanager'))
				<a href="{{route('admin.post.create')}}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add New</a>
				
				<button class="btn btn-danger" data-method="remove" id="btn-remove">Remove</button>
				@endif
			</div>

			@if(!is_null($user))
			<table data-classes="table table-no-bordered" id="table-post" width="100%" data-striped="true" data-page-number="1" data-page-size="5" data-pagination="true" data-page-list="[5,10,15,20]" data-show-toggle="true" data-click-to-select="true" data-select-item-name="id_field[]" data-toggle="table" data-search="true">
				<thead>
					<tr>
						<th data-checkbox="true"></th>
						<th data-field="id">ID</th>
						<th data-field="email">Email</th>
						<th data-field="date">Create date</th>
						<th>Activated</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($user as $item)
					<tr>
						<td></td>
						<td>{{$item->id}}</td>
						<td>{{$item->email}}</td>
						<td>{{\Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</td>
						<td >{{$item->confirmed == 1 ? "activated" : "Not yet"}}</td>
						<td> <a href="{{route('admin.user.updateRole', array($item->id))}}" class="btn btn-info">Update Group</a> <button class="btn  btn-danger" onclick="confirm_action(this)"  href="{{route('admin.user.delete',array($item->id))}}" > Remove </button> <button type="button" href="{{route('admin.user.resetPass',array($item->id))}}" onclick="confirm_action(this)" class="btn btn-warning">Reset password</button> </td>
					</tr>
					@endforeach
				</tbody>
				
			</table>
			@else
			<h4> No data</h4>
			@endif

		</div>
	</div>
</div>
@stop
@section('script')

	{{HTML::script('public/backend/assets/js/table-bootstrap/bootstrap-table.js')}}
	{{HTML::style('public/backend/assets/js/table-bootstrap/bootstrap-table.css')}}

	<script type="text/javascript">
		$(document).ready(function(){
			{{Notification::showSuccess('alertify.success(":message");') }}
			{{Notification::showError('alertify.error(":message");') }}

			// REMOVE ALL
			$('#btn-remove').click(function(){
				var select = $("#table-post").bootstrapTable('getSelections');
				var id = $.map(select,function(row){
					return row.id;
				});
				alertify.confirm("You can not undo this action. Are you sure ?", function(e){
					if(e){
						$.ajax({
							url:"{{route('admin.user.deleteall')}}",
							type:"POST",
							data: {arr : id},
							
							success:function(data){
								if(data.msg == 'error'){
									alertify.error("Please check items selected !");	
								}else{
									alertify.success("Deleted !");
									$('#table-post').bootstrapTable('remove',{
										field: 'id',
										values: id
									});
								}
								
							}
						})
						
					}
				});
				
			});
		});

		function confirm_action(val){
			alertify.confirm('Do you want to confirm this action!',function(e){
				if(e){
					window.location.href = $(val).attr('href');
				}
			})
		}
		
	</script>
@stop