@extends('admin::layouts.default')

@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<h4 class="page-head-line">Add New</h4>
		</div>
		<div class="row">
			{{Form::model($post ,array('route'=>array('admin.post.update',$post->id), 'method'=>'PUT' )) }}
				<div class="col-sm-8">
					<div class="form-group">
						<label for="title">Title</label>
						{{Form::text('title',Input::old('title'), array('class' => 'form-control') )}}
					</div>
					<div class="form-group">
						<label for="content">Content</label>
						{{Form::textarea('content',Input::old('content'), array('class' => 'form-control ckeditor') )}}
					</div>
					<div class="form-group">
						<label for="title">Position</label>
						{{Form::text('sort',Input::old('sort'), array('class' => 'form-control') )}}
					</div>
					<div class="form-group">
						<label for="title">Status</label>
						{{Form::select('show',array('0' => 'hide', '1'=>'show'), Input::old('show'), array('class'=>'form-control') )}}
					</div>
					@if(count($post->addition()->get()) != 0 )
					<fieldset>
						<legend>Addition Attributes  </legend>
						<div class="wrap-area">
							<div class="area-addition">
								<div class="form-group form-addition" id="area">
									@if($post->addition()->get()->count() == 0)
										<div class="row">
											<div class="col-sm-5">
												<label for="attr">Attribute</label>
												{{Form::text('attr[]','', array('class' => 'form-control attr') )}}
											</div>
											<div class="col-sm-5">
												<label for="">Value</label>
												{{Form::text('value_attr[]','', array('class'=> 'form-control val_attr' ))}}
											</div>

										</div>
									@else
										@foreach($post->addition()->get() as $item)
										<div class="row">
											<div class="col-sm-5">
												<label for="attr">Attribute</label>
												{{Form::text('attr[]',$item->key, array('class' => 'form-control attr') )}}
											</div>
											<div class="col-sm-5">
												<label for="">Value</label>
												{{Form::text('value_attr[]',$item->value, array('class'=> 'form-control val_attr' ))}}
											</div>
											<div class="col-sm-2">
												 <label style="opacity:0">Remove</label>
												<button class="btn btn-danger pull-right btn-remove" alt-id="{{$item->id}}" type="button">Remove</button>
											</div>
										</div>
										@endforeach
									@endif
								</div>
							</div>  <!--end area-addition -->

						</div>  <!-- end wrap-area-->

					</fieldset>
					@endif
					<div class="form-group form-btn-add clearfix">
						<button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Add more Addition</button>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-group">
						<label for="title">Categrory</label>
						{{Form::select('cate_id',$list,0,array('class'=> 'form-control') )}}

					</div>
					<div class="form-group">
						<label for="img">Featured Image</label>
						<button type="button" id="open_img" class="btn btn-primary" onclick="openCKFinder()">Choose images</button>
						<div id="preview_img">
							<img src="{{asset($post->path_thumb)}}" id="pre" class="img-responsive" />
						</div>
						
						{{Form::hidden('img-bk',$post->path_thumb, array('class'=>'form-control'))}}
					</div>
					<div class="form-group form-submit">
						{{Form::submit('Save Changes', array('class' => 'btn btn-primary pull-right'))}}
						<a href="{{URL::previous()}}" class="btn btn-warning pull-right" style="margin-right:20px">Cancel</a>
						

					</div>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>

<!-- MODAL ADD MORE ADDITION -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add more Addition</h4>
			</div>
			{{Form::open(array('route'=>array('admin.post.more_addition',$post->id)) )}}
			<div class="modal-body" id="modal-addition">
				<div class="each-addition">
					<div class="form-group">
						{{Form::label('Attribute')}}
						{{Form::text('modal_attr[]','',array('class'=>'form-control '))}}
					</div>
					<div class="form-group">
						{{Form::label('Value')}}
						{{Form::text('modal_attr_value[]','',array('class'=>'form-control '))}}
					</div>
				</div>

			</div>

			<div class="modal-footer">
				{{Form::button('Add more',array('class'=>'btn btn-success pull-left','onclick'=>'addRow()') )}}
				{{Form::submit('Save changes',array('class'=>'btn btn-primary pull-right'))}}

			</div>
			{{Form::close()}}
		</div>
	</div>
</div>

@stop

@section('script')
	{{HTML::script('public/backend/assets/js/radio/bootstrap-switch.min.js')}}
	{{HTML::style('public/backend/assets/js/radio/bootstrap-switch.css')}}
	{{HTML::script('public/backend/assets/js/ckfinder/ckfinder.js')}}
	<script type="text/javascript">
		$(document).ready( function(){
			$(".cb-enable").click(function(){
			    var parent = $(this).parents('.switch');
			    $('.cb-disable',parent).removeClass('selected');
			    $(this).addClass('selected');
			    $('.checkbox',parent).attr('checked', true);
			});
			$(".cb-disable").click(function(){
			    var parent = $(this).parents('.switch');
			    $('.cb-enable',parent).removeClass('selected');
			    $(this).addClass('selected');
			    $('.checkbox',parent).attr('checked', false);
			});
			if ({{$count}} != 0){
				$('.probeProbe').bootstrapSwitch('state', true);
				$(".wrap-area").show();
			}else{
				$('.probeProbe').bootstrapSwitch('state', false);
			}


			$('.probeProbe').on('switchChange.bootstrapSwitch', function (event, state) {
			        if(state == true){
			           $(".wrap-area").fadeIn();
			           $('input.probeProbe').val('1');
			        }else{
			        	var id = {{$post->id}};
			        	alertify.confirm('This action will delete all addition post ! Are you sure ?', function(e){
			        		if(e){
					           $.ajax({
					           	url: "{{route('admin.post.remove_add_edit')}}",
					           	type:'POST',
					           	data: {id: id},
					           	success:function(data){
					           		location.reload();
					           	}
					           })
			        		}else{
			        			$('.probeProbe').bootstrapSwitch('state', true);
			        		}
			        	});
			        }
			});

			// REMOVE ADD
			$(".btn-remove").click(function(){
				var it = $(this)
				alertify.confirm('This action can not undo ! Are you sure ?', function(e){
					var id = it.attr('alt-id');
					$.ajax({
						url:"{{route('admin.post.remove_addition')}}",
						type: 'POST',
						data: {id:id},
						success:function(data){
						 	console.log(data.msg);
						}
					})
					it.parent().parent().remove();
				});
			})

		});

		function addRow(){
			var area = document.getElementById('modal-addition');

			var div1 = document.createElement('div');
			div1.className="each-addition";

			var div2 = document.createElement('div');
			div2.className="form-group";

			var div3 = document.createElement('div');
			div3.className="form-group";

			var label1 = document.createElement('label');
			var text_label1 = document.createTextNode('Attribute');
			label1.appendChild(text_label1);

			var input1 = document.createElement('input');
			input1.setAttribute('type','text');
			input1.setAttribute('name','modal_attr[]');
			input1.setAttribute('class','form-control');

			var label2 = document.createElement('label');
			var text_label2 = document.createTextNode('Value');
			label2.appendChild(text_label2);

			var input2 = document.createElement('input');
			input2.setAttribute('type','text');
			input2.setAttribute('name','modal_attr_value[]');
			input2.setAttribute('class','form-control');

			var label3 = document.createElement('label');
			label3.setAttribute('style','opacity:0');
			var text_label3 = document.createTextNode('Remove');
			label3.appendChild(text_label3);

			var btn_remove = document.createElement('button');
			btn_remove.setAttribute('class', 'btn btn-danger pull-right');
			btn_remove.setAttribute('type', 'button');
			btn_remove.setAttribute('onclick', 'remove_btn(this)');
			var remove_text = document.createTextNode('Remove');
			btn_remove.appendChild(remove_text);


			div2.appendChild(label1);
			div2.appendChild(input1);

			div3.appendChild(label2);
			div3.appendChild(input2);
			div3.appendChild(btn_remove);

			div1.appendChild(div2)
			div1.appendChild(div3)

			area.appendChild(div1);
		}

		function remove_btn(val){
			val.parentNode.parentNode.remove();

		}
		// CONFIG KCFinder
		// function openKCFinder() {
		//     window.KCFinder = {
		//         callBack: function(url) {
		//             window.KCFinder = null;
		//             var div = document.getElementById("preview_img");
		//             var pre =  document.getElementById("pre");
		//             div.innerHTML = '<div style="margin:5px">Loading...</div>';
		//             var img = new Image();
		//             img.src = url;
		//             img.onload = function() {
		//                 div.innerHTML = '<img id="img" width="320" src="' + url + '" />' + '<input type="hidden" name="file" value="' + url+ '" />';
		//                 pre.remove();
		//                 var img = document.getElementById('img');
		//                 var o_w = img.offsetWidth;
		//                 var o_h = img.offsetHeight;
		//                 var f_w = div.offsetWidth;
		//                 var f_h = div.offsetHeight;
		//                 if ((o_w > f_w) || (o_h > f_h)) {
		//                     if ((f_w / f_h) > (o_w / o_h))
		//                         f_w = parseInt((o_w * f_h) / o_h);
		//                     else if ((f_w / f_h) < (o_w / o_h))
		//                         f_h = parseInt((o_h * f_w) / o_w);
		//                     img.style.width = f_w + "px";
		//                     img.style.height = f_h + "px";
		//                 } else {
		//                     f_w = o_w;
		//                     f_h = o_h;
		//                 }
		//                 // img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
		//                 // img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
		//                 img.style.visibility = "visible";
		//             }
		//         }
		//     };
		//     window.open('{{asset("public")}}/backend/assets/js/kcfinder/browse.php?type=images&dir=images',
		//         'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
		//         'directories=0, resizable=1, scrollbars=0, width=800, height=600'
		//     );
		// }

		// CONFIG CKFINDER
		function openCKFinder(){
			var finder = new CKFinder();
			finder.basePath = "{{asset('public/upload')}}";	// The path for the installation of CKFinder (default = "/ckfinder/").
			finder.selectActionFunction = ShowFileInfo;
			finder.popup();
		}
		function ShowFileInfo( fileUrl, data, allFiles ){
			if(allFiles.length > 1){
				alertify.error('Please choose only 1 image !');
			}else{
				var div = document.getElementById("preview_img");
				var img = document.createElement("IMG");
				img.id = 'img-pre';
				img.setAttribute('class', 'img-responsive');
				img.setAttribute('src',fileUrl);
			           div.innerHTML = '';
			           div.appendChild(img);

			           var input = document.createElement('INPUT');
			           input.setAttribute('type','hidden');
			           input.setAttribute('name','file');
			           input.setAttribute('value',fileUrl);
			           div.appendChild(input);
			}
		}
	</script>
@stop