@extends('admin::layouts.default')
@section('content')
<section class="content-header">
  <h1>Khách hàng liên hệ</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
	            <div class="box-header">
	              <div class="pull-right">
					<button class="btn btn-danger btn-xs" data-method="remove" id="btn-remove">Remove</button>
	              </div>
	            </div>
	            <!-- /.box-header -->
	            @if($customer->count() != 0)
				<div class="box-body">

				  <table id="table-post" class="table table-bordered table-striped" data-page-number="1" data-page-size="10" data-pagination="true" data-page-list="[5,10,15,20]" data-show-toggle="true" data-click-to-select="true" data-select-item-name="id_field[]" data-toggle="table">
				    <thead>
				    <tr>
						<th data-checkbox="true" ></th>
						<th data-field="id" class="sr-only" data-width="0%" >ID</th>
						<th data-field="title" data-width="75%">Tên khách hàng</th>
						<th data-width="20%">Action</th>
					</tr>
				    </thead>
				    <tbody>
					    @foreach($customer as $item)
						<tr>
							<td></td>
							<td >{{$item->id}}</td>
							<td><b>{{$item->fullname}}</b></td>
							<td><a href="{{route('admin.customer.show',$item->id)}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> View </a> <button class="btn  btn-danger btn-xs" onclick="confirm_remove(this)"  href="{{route('admin.customer.delete', array($item->id) )}}" > Remove </button></td>
						</tr>
						@endforeach
				    </tbody>
				    <tfoot>
				    	
				    </tfoot>
				   
				  </table>
				</div>
				@else
					<h2 class="text-center">Chưa có thông tin liên hệ</h2>
				@endif
            <!-- /.box-body -->
			</div>
			</div>	<!-- end ajax-table-->

		</div>
	</div>
</section>
@stop

@section('script')
	<!-- SCRIPT -->
	{{HTML::script('public/backend/js/table-bootstrap/bootstrap-table.js')}}
	{{HTML::style('public/backend/js/table-bootstrap/bootstrap-table.css')}}

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
							url:"{{route('admin.customer.deleteAll')}}",
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
		})

		function confirm_remove(val){
			alertify.confirm('You can not undo this action. Are you sure ?', function(e){
				if(e){
					var a = val.getAttribute('href');
					window.location.href= a;
				}
			});
		}
	</script>

@stop