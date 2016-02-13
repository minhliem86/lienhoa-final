@extends('admin::layouts.default')

@section('content')
<section class="content-header">
	<h1>Add New Image</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				{{Form::open(array('route'=>array('admin.image.store'),'class'=>'formAdmin form-horizontal','files'=>true))}}
					<div style="margin-bottom:10px">
						<button class="btn btn-info" type="button" onclick="openCKFinder()">Choose images</button>
						<!-- <button class="btn btn-info" type="button" onclick="openCKFinder()">Choose image</button> -->
				    	<div id="preview_img"></div>
					</div>

					<div style="margin-bottom:10px">
							{{Form::submit('Save',array('class'=>'btn btn-primary'))}}
					</div>
					{{Form::hidden('album_id',$album_id)}}
				{{Form::close()}}
			</div>
		</div>
	</div>
	
</section>
@stop

@section('script')
{{HTML::script('public/backend/js/ckfinder/ckfinder.js')}}
<script>
	$(document).ready(function(){
			{{Notification::showSuccess('alertify.success(":message");') }}
			{{Notification::showError('alertify.error(":message");') }}
	})
	function remove_file(value){
		$('li.img_group').remove(value);
	}

	// CONFIG CKFINDER
	function openCKFinder(){
		var finder = new CKFinder();
		finder.basePath = "{{asset('public/upload')}}";	// The path for the installation of CKFinder (default = "/ckfinder/").
		finder.selectActionFunction = ShowFileInfo;
		finder.popup();

	}
	function ShowFileInfo( fileUrl, data, allFiles ){
		var div = document.getElementById("preview_img");
		var finder = new CKFinder();
		var api = finder.popup();
		if(allFiles.length == 1){
			var li = document.createElement('li');
		        		li.setAttribute('class','img_group');
		        		li.setAttribute('id','img_group_'+data["fileDate"]);

		        		var img = document.createElement('img');
		        		img.src= fileUrl;
		        		img.setAttribute('width','100%');
		        		li.appendChild(img);

		        		var btn_remove = document.createElement('span');
		        		btn_remove.setAttribute('class', 'remove_btn');
		        		btn_remove.setAttribute('onclick', 'remove_file("#img_group_'+data["fileDate"]+' ")');

		        		var img_remove = document.createElement('img');
		        		img_remove.setAttribute('title', 'Remove file');
		        		img_remove.src="{{asset('public')}}/backend/img/Remove.png";
		        		btn_remove.appendChild(img_remove);

				var elem = document.createElement("input");
				elem.type = "hidden";
				elem.setAttribute('class','img_group_input');
				elem.setAttribute('name','img[]');
				elem.value =fileUrl;

				var title = document.createElement("input");
				title.type="text";
				title.name = "title[]";
				title.setAttribute('class','form-control title');
				title.setAttribute('placeholder','Enter alt text');


				li.appendChild(elem);

				li.appendChild(btn_remove);

				li.appendChild(title);
				div.appendChild(li);
		}else{
			for(var i = 0; i <= allFiles.length ; i++){
				var li = document.createElement('li');
		        		li.setAttribute('class','img_group');
		        		li.setAttribute('id','img_group_'+i);

		        		var img = document.createElement('img');
		        		img.src= allFiles[i].url;
		        		img.setAttribute('width','100%');
		        		li.appendChild(img);

		        		var btn_remove = document.createElement('span');
		        		btn_remove.setAttribute('class', 'remove_btn');
		        		btn_remove.setAttribute('onclick', 'remove_file("#img_group_'+i+' ")');

		        		var img_remove = document.createElement('img');
		        		img_remove.setAttribute('title', 'Remove file');
		        		img_remove.src="{{asset('public')}}/backend/img/Remove.png";
		        		btn_remove.appendChild(img_remove);

				var elem = document.createElement("input");
				elem.type = "hidden";
				elem.setAttribute('class','img_group_input');
				elem.setAttribute('name','img[]');
				elem.value =allFiles[i].url;

				var title = document.createElement("input");
				title.type="text";
				title.name = "title[]";
				title.setAttribute('class','form-control title');
				title.setAttribute('placeholder','Enter alt text');


				li.appendChild(elem);

				li.appendChild(btn_remove);

				li.appendChild(title);
				div.appendChild(li);
				api.closePopup();
			}
		}
	}

	// CONFIG KDFINDER
	// function openKCFinder() {
	// 	window.KCFinder = {
	// 	    callBackMultiple: function(files) {
	// 	        window.KCFinder = null;
	// 	        var div = document.getElementById("preview_img");
	// 	        for (var i = 0; i < files.length; i++){
	// 	        		var li = document.createElement('li');
	// 	        		li.setAttribute('class','img_group');
	// 	        		li.setAttribute('id','img_group_'+i);
	// 	        		var img = document.createElement('img');
	// 	        		img.src= files[i];
	// 	        		img.setAttribute('width','100%');
	// 	        		li.appendChild(img);

	// 	        		var btn_remove = document.createElement('span');
	// 	        		btn_remove.setAttribute('class', 'remove_btn');
	// 	        		btn_remove.setAttribute('onclick', 'remove_file("#img_group_'+i+' ")');

	// 	        		var img_remove = document.createElement('img');
	// 	        		img_remove.setAttribute('title', 'Remove file');
	// 	        		img_remove.src="{{asset('public')}}/backend/assets/img/Remove.png";
	// 	        		btn_remove.appendChild(img_remove);

	// 			var elem = document.createElement("input");
	// 			elem.type = "hidden";
	// 			elem.setAttribute('class','img_group_input');
	// 			elem.setAttribute('name','img[]');
	// 			elem.value = files[i];

	// 			var title = document.createElement("input");
	// 			title.type="text";
	// 			title.name = "title[]";
	// 			title.setAttribute('class','form-control title');
	// 			title.setAttribute('placeholder','Enter alt text');


	// 			li.appendChild(elem);

	// 			li.appendChild(btn_remove);

	// 			li.appendChild(title);
	// 			div.appendChild(li);

	// 	        }
	// 	}
	// 	}
	// 	window.open('{{asset("public")}}/backend/assets/js/kcfinder/browse.php?type=images&dir=images',
	// 	        'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
	// 	        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
	// 	    );
	// }
</script>
@stop