@extends('admin.shared.layout')
@section('title','Banners')
@section('content')
	<div class="page-header custom">
		<h1>Banners</h1>
	</div>
<div class="row">
	<div class="col-xs-4">
		{!! Form::open(['url'=>'admin/banners/', 'method'=>'GET']) !!}
			<div class="form-group">
				<input type="text" name="search" class="search" placeholder="Type and press Enter to search..." value="{{$param}}" />
				<a href="{{url('admin/banners')}}" class="btn btn-danger sbtn" style="margin-top: 5px" title="Clear search">Clear</a>
			</div>
			{{Form::token()}}
		{!! Form::close() !!}
	</div>
	<div class="pull-right">
		<p>
			<a href="{{url('admin/banners/create')}}" class="btn btn-info btn-xs">
			<span class="glyphicon glyphicon-plus"></span>
			</a>
		</p>
	</div>
</div>
<table class="table custom">
	<thead>
		<tr>
			<th>Id</th>
			<th>Title</th>
			<th>Image</th>
			<th>Added Date</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($banners as $value): ?>
			<tr>
				<td>{{$value->id}}</td>
				<td>{{$value->title}}</td>
				<td>
					<img src="{{Storage::url($value->image)}}" style="width: 200px;height: 100px" alt="No image available" />
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
					{!! Form::open(['url'=>'admin/banners/'.$value->id, 'method'=>'DELETE']) !!}
					<a href="{{url('admin/banners/'.$value->id.'/edit')}}" class="btn btn-warning btn-xs">
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