@extends('admin::layouts.default')
@section('content')
<section class="content-header">
  <h1>Danh mục Sản Phẩm: {{$danhmuc->title}}</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
	            <div class="box-header">
	              <div class="pull-right">
	              	<a href="{{route('admin.sanpham.create',$danhmuc_id)}}" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-plus"></i> Add New</a>
					<button class="btn btn-danger btn-xs" data-method="remove" id="btn-remove">Remove</button>
	              </div>
	            </div>
	            <!-- /.box-header -->
	            @if($sanpham->count() != 0)
				<div class="box-body">

				  <table id="table-post" class="table table-bordered table-striped" data-page-number="1" data-page-size="10" data-pagination="true" data-page-list="[5,10,15,20]" data-show-toggle="true" data-click-to-select="true" data-select-item-name="id_field[]" data-toggle="table">
				    <thead>
				    <tr>
						<th data-checkbox="true"></th>
						<th data-field="id" class="sr-only">ID</th>
						<th data-field="title" data-width="40%">Tên Sản Phẩm</th>
						<th data-field="image">Hình ảnh</th>
						<th>Trạng thái</th>
						<th data-width="8%" data-halign="center"><button type="button" class="btn btn-xs btn-warning" id="re-sort">Thứ tự</button></th>
						<th data-width="8%">Khuyến mãi</th>
						<th data-width="18%">Thao tác</th>
					</tr>
				    </thead>
				    <tbody>
					    @foreach($sanpham as $item)
						<tr>
							<td></td>
							<td class="sr-only">{{$item->id}}</td>
							<td><b>{{$item->name}}</b></td>
							<td><img src="{{asset($item->image_path)}}"  style="max-width:50px"></td>
							<td >
							{{Form::select('show', array('0'=>'Ẩn', '1'=>'Hiện'), $item->status, array('class'=>'form-control', 'id'=>$item->id ) )}}</td>
							<td>{{Form::text('order',$item->order,array('class' => 'form-control text-center', 'id'=>$item->id))}}</td>
							<td data-align="center">{{Form::checkbox('khuyenmai',$item->khuyenmai,$item->khuyenmai == 1 ? true : false,array('class' => 'icheck','id'=>$item->id))}}</td>
							<td><a href="{{route('admin.sanpham.edit',array($danhmuc_id,$item->id))}}" class="btn btn-info btn-xs"> Edit </a> <button class="btn  btn-danger btn-xs" onclick="confirm_remove(this)"  href="{{route('admin.sanpham.delete', array($item->id) )}}" > Remove </button></td>
						</tr>
						@endforeach
				    </tbody>
				    <tfoot>

				    </tfoot>

				  </table>
				</div>
				@else
					<h2 class="text-center">Hiện chưa có sản phẩm</h2>
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
	<!-- ICHECK -->
	{{HTML::style('public/backend/plugins/iCheck/all.css')}}
	{{HTML::script('public/backend/plugins/iCheck/icheck.min.js')}}

	<script type="text/javascript">
		$(document).ready(function(){
			{{Notification::showSuccess('alertify.success(":message");') }}
			{{Notification::showError('alertify.error(":message");') }}


			// SHOW/HIDE
			$('select[name="show"]').change(function(){
				var id = $(this).attr('id');
				var val = $(this).val();
				$.ajax({
					'url' : "{{route('admin.sanpham.status')}}",
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
							url:"{{route('admin.sanpham.deleteAll')}}",
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
			$('#re-sort').click(function(){
				$('input[name="order"]').each(function(e){
					var field_id = $(this).attr('id');
					console.log(field_id);
					$.ajax({
						url: "{{route('admin.sanpham.order')}}",
						type: 'POST',
						data: {value:$(this).val(), id:field_id},
						'beforeSend':function(){
							$('.wrap-loading').fadeIn();
						},
						success: function(respon){
							$('.wrap-loading').fadeOut();
						}

					})
				})
				alertify.success('Sorted !');
			});

			// ICHECK CHECKBOX
			$('input[name="khuyenmai"]').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
			});

			$('input[name="khuyenmai"]').on('ifToggled', function(event){
				var id = $(this).attr('id');
				if($(this).prop('checked')){
					var khuyenmai = 1;
				}else{
					var khuyenmai = 0;
				}
				$.ajax({
					url:"{{route('admin.sanpham.khuyenmai')}}",
					type: 'POST',
					data: {id:id, value:khuyenmai },
					'beforeSend':function(){
						$('.wrap-loading').fadeIn();
					},
					success: function(respon){
						$('.wrap-loading').fadeOut();
						// window.location.reload();
					}
				})
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