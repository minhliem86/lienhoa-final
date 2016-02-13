@extends('admin::layout.default')

@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
		</div>
		<div class="row">
			<div class="col-sm-5">
				<h4 class="page-head-line">Add New</h4>
				<form action="" method="post" class="formAddCate">
				{{Form::open(array('route'=>'') )}}
					<div class="form-group">
						<label for="title">Title Categrory</label>
						<input type="text" name="title" class="form-control">
					</div>
					<div class="form-group">
						<label for="title">Parent</label>
						<select name="parent_id" id="" class="form-control">
							<option value=""> -- </option>
							<option value=""> 1 </option>
							<option value=""> 2 </option>
						</select>
					</div>
					<div class="form-group form-submit">
						<input type="submit" value="Apply" class="btn btn-primary pull-right">
					</div>
					
				</form>
			</div>
			<div class="col-sm-7">
				<h4 class="page-head-line">Categrories</h4>
				<form action="" class="formRemoveCate">
					<table class="table table-striped  table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Parent</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>About</td>
								<td> -- </td>
								<td><a href="#" class="btn btn-info"> Edit </a>  <input type="submit" class="btn btn-danger" value="Remove"/></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Contact</td>
								<td> -- </td>
								<td><a href="#" class="btn btn-info"> Edit </a>  <input type="submit" class="btn btn-danger" value="Remove"/></td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
@stop