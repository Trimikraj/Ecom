@extends('admin.shared.layout')
@section('title','Coupons')
@section('content')
	<div class="page-header custom">
		<h1>Coupons</h1>
	</div>
	<div class="pull-right">
		<p>
			<a href="{{url('admin/coupons/create')}}" class="btn btn-info btn-xs" title="Add Coupon">
			<span class="glyphicon glyphicon-plus"></span>
			</a>
		</p>
	</div>
<table class="table custom">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Added Date</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($coupons as $value): ?>
			<tr>
				<td>{{$value->id}}</td>
				<td>{{$value->name}}</td>
				<td>{{$value->created_at}}</td>
				<td>
					<?php if ($value->status): ?>
						<label class="label label-success"> Active</label>
					<?php else: ?>
						<label class="label label-danger"> Inactive</label>
					<?php endif ?>
				</td>
				<td>
					{!! Form::open(['url'=>'admin/coupons/'.$value->id, 'method'=>'DELETE']) !!}
					<a href="{{url('admin/coupons/'.$value->id.'/edit')}}" class="btn btn-warning btn-xs">
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