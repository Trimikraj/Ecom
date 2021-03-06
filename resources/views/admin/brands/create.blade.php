@extends('admin.shared.layout')
@section('title','Add Brand')
@section('content')
<div class="page-header custom">
	<h1>Add Brand</h1>
</div>

{!! Form::open(['url'=>'admin/brands','method'=>'POST','enctype'=>'multipart/form-data','class'=>'custom']) !!}
	<div class="col-xs-8">
		<div class="form-group col-xs-12">
			{{Form::label('name','Name')}}
			{{Form::text('name','',['class'=>'form-control','title'=>'Title of the Brand'])}}	
			@if($errors->has('name'))
				<div style="color:red" class="col-xs-12">
					{{$errors->first('name')}}
				</div>
			@endif
		</div>
		<div class="form-group col-xs-12">
			{{Form::label('description','Description')}}
			{{Form::textarea('description','',['class'=>'form-control','title'=>'Description of the Brand','style'=>"min-height: 150px; max-height:150px; min-width: 100%; max-width: 100%"])}}	
			@if($errors->has('description'))
				<div style="color:red" class="col-xs-12">
					{{$errors->first('description')}}
				</div>
			@endif
		</div>
		<div class="form-group col-xs-12">
			{{Form::label('image','Image')}}
			{{Form::file('image')}}
		</div>
		<div class="form-inline col-xs-12">
			{{Form::label('status','Status')}}
			<label>
				{{Form::checkbox('status')}}
				Is Active
			</label>
		</div>
	</div>
	<div class="col-xs-8">
		{{Form::token()}}
		<div class="col-xs-12">
			{{link_to('admin/brands','Back',['class'=>'btn btn-danger'])}}	
			<button type="submit" class="btn btn-success">Save</button>
		</div>
	</div>
{!! Form::close() !!}
@endsection()