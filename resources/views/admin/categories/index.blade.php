@extends('admin.shared.layout')
@section('title','Categories')
@section('content')
	<div class="page-header custom">
		<h1>Categories</h1>
	</div>
<div class="row">
	<div class="col-xs-4">
		{!! Form::open(['url'=>'admin/categories/', 'method'=>'GET']) !!}
			<div class="form-group">
				<input type="text" name="search" class="search" placeholder="Type and press Enter to search..." value="{{$param}}" />
				<a href="{{url('admin/categories')}}" class="btn btn-danger sbtn" style="margin-top: 5px" title="Clear search">Clear</a>
			</div>
			{{Form::token()}}
		{!! Form::close() !!}
	</div>
	<div class="pull-right">
		<p>
			<a href="{{url('admin/categories/create')}}" class="btn btn-info btn-xs">
			<span class="glyphicon glyphicon-plus"></span>
			</a>
		</p>
	</div>
</div>
<table class="table custom">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Image</th>
			<th>Added Date</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($categories as $value): ?>
			<tr>
				<td>{{$value->id}}</td>
				<td>{{$value->name}}</td>
				<td>
					<img src="{{Storage::url($value->image)}}" style="width: 100px;height: 100px" alt="No image available" />
				</td>
				<td>{{$value->created_at}}</td>
				<td>
					<?php if ($value->status): ?>
						<label class="label label-success"> Active</label>
					<?php else: ?>
						<label class="label label-danger"> Inactive</label>
					<?php endif ?>
				</td>
				<td>
					{!! Form::open(['url'=>'admin/categories/'.$value->id, 'method'=>'DELETE']) !!}
					<a href="{{url('admin/categories/'.$value->id.'/edit')}}" class="btn btn-warning btn-xs">
						<span class="glyphicon glyphicon-pencil"></span>
					</a>
					<button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to Delete ?')">
						<span class="glyphicon glyphicon-trash"></span>
					</button>
					{{Form::token()}}
					{!! Form::close() !!}
				</td>
			</tr>	
		<?php endforeach ?>	
	</tbody>
</table>
@endsection