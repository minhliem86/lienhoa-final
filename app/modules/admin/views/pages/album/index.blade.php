@extends('admin::layouts.default')
@section('content')
<section class="content-header">
  <h1>Albums</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
	            <div class="box-header">
	              <div class="pull-right">
	              	<a href="{{route('admin.album.create')}}" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-plus"></i> Add New</a>
					<button class="btn btn-danger btn-xs" data-method="remove" id="btn-remove">Remove</button>
	              </div>
	            </div>
	            <!-- /.box-header -->
	            @if($album->count() != 0)
				<div class="box-body">

				  <table id="table-post" class="table table-bordered table-striped" data-page-number="1" data-page-size="15" data-pagination="true" data-page-list="[5,10,15,20]" data-show-toggle="true" data-click-to-select="true" data-select-item-name="id_field[]" data-toggle="table">
				    <thead>
				    <tr>
						<th data-checkbox="true"></th>
						<th data-field="id" class="sr-only">ID</th>
						<th data-field="title" data-width="60%">Tên Album</th>
						<th>Trạng thái</th>
						<th>Thao tác</th>
					</tr>
				    </thead>
				    <tbody>
					    @foreach($album as $item)
						<tr>
							<td></td>
							<td class="sr-only">{{$item->id}}</td>
							<td><b><a href="{{route('admin.image.index',$item->id)}}">{{$item->title}}</a></b></td>
							<td >
							{{Form::select('show', array('0'=>'Ẩn', '1'=>'Hiện'), $item->show, array('class'=>'form-control', 'id'=>$item->id ) )}}</td>
							<td><a href="{{route('admin.album.edit', array($item->id) )}}" class="btn btn-info btn-xs"> Edit </a> <button class="btn  btn-danger btn-xs" onclick="confirm_remove(this)"  href="{{route('admin.album.delete', array($item->id) )}}" > Remove </button></td>
						</tr>
						@endforeach
				    </tbody>
				    <tfoot>

				    </tfoot>

				  </table>
				</div>
				@else
					<h2 class="text-center">No Data</h2>
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


			// SHOW/HIDE
			$('select[name="show"]').change(function(){
				var id = $(this).attr('id');
				var val = $(this).val();
				$.ajax({
					'url' : "{{route('admin.album.status')}}",
					'type' : 'POST',
					'data' : {id:id,value:val},
					'beforeSend':function(){
						$('.wrap-loading').fadeIn();
					},
					'success': function(data){
						$('.wrap-loading').fadeOut();
						alertify.success('Status has changed !');
					},
				});
			});

			// REMOVE ALL
			$('#btn-remove').click(function(){
				var select = $("#table-post").bootstrapTable('getSelections');
				var id = $.map(select,function(row){
					return row.id;
				});

				alertify.confirm("You can not undo this action. Are you sure ?", function(e){
					if(e){
						$.ajax({
							url:"{{route('admin.album.deleteAll')}}",
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