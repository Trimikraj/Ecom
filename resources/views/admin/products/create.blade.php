@extends('admin.shared.layout')
@section('title','Add Product')
@section('content')
<div class="page-header custom">
	<h1>Add Product</h1>
</div>

{!! Form::open(['url'=>'admin/products','method'=>'POST','enctype'=>'multipart/form-data','class'=>'custom']) !!}
<div>
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" class="custom" data-toggle="tab">Details</a></li>
		<li role="presentation"><a href="#meta" aria-controls="meta" role="tab" class="custom" data-toggle="tab">Meta</a></li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content col-xs-8">
		<div role="tabpanel" class="tab-pane active" id="details">
			<div class="form-group col-xs-12">
				{{Form::label('name','Name')}}
				{{Form::text('name','',['class'=>'form-control','title'=>'Name of the Product'])}}	
				@if($errors->has('name'))
					<div style="color:red" class="col-xs-12">
						{{$errors->first('name')}}
					</div>
				@endif
			</div>
			<div class="form-group col-xs-12">
				{{Form::label('description','Description')}}
				{{Form::textarea('description','',['class'=>'form-control','title'=>'Description of the Product','style'=>"min-height: 150px; max-height:150px; min-width: 100%; max-width: 100%"])}}	
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
			<div class="form-group col-xs-12">
				{{Form::label('quantity','Quantity')}}
				{{Form::text('quantity','',['class'=>'form-control','title'=>'Quantity of the Product'])}}	
				@if($errors->has('quantity'))
					<div style="color:red" class="col-xs-12">
						{{$errors->first('quantity')}}
					</div>
				@endif
			</div>
			<div class="form-group col-xs-12">
				{{Form::label('price','Price')}}
				{{Form::text('price','',['class'=>'form-control','title'=>'Price of the Product'])}}	
				@if($errors->has('price'))
					<div style="color:red" class="col-xs-12">
						{{$errors->first('price')}}
					</div>
				@endif
			</div>
			<div class="form-group col-xs-12">
				{{Form::label('category','Category')}}
				<select name="category" class="form-control">
					<option value="">--- Select Category ---</option>
					<?php foreach ($category as $c): ?>
						<option value="{{$c->id}}">{{$c->name}}</option>
					<?php endforeach ?>
				</select>
				@if($errors->has('category'))
					<div style="color:red" class="col-xs-12">
						{{$errors->first('category')}}
					</div>
				@endif
			</div>
			<div class="form-group col-xs-12">
				{{Form::label('brand','Brand')}}
				<select name="brand" class="form-control">
					<option value="">--- Select Brand ---</option>
					<?php foreach ($brand as $b): ?>
						<option value="{{$b->id}}">{{$b->name}}</option>
					<?php endforeach ?>
				</select>
				@if($errors->has('brand'))
					<div style="color:red" class="col-xs-12">
						{{$errors->first('brand')}}
					</div>
				@endif
			</div>
			<div class="form-group col-xs-12">
				{{Form::label('display_order','Display order')}}
				{{Form::text('display_order','',['class'=>'form-control','title'=>'Display order of the Category'])}}	
				@if($errors->has('display_order'))
					<div style="color:red" class="col-xs-12">
						{{$errors->first('display_order')}}
					</div>
				@endif
			</div>
			<div class="form-inline col-xs-12">
				{{Form::label('status','Status')}}
				<label>
					{{Form::checkbox('status')}}
					Is Active
				</label>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="meta">
			<div class="form-group col-xs-12">
				{{Form::label('meta_description','Meta Description')}}
				{{Form::textarea('meta_description','',['class'=>'form-control','title'=>'Meta Description of the Product','style'=>"min-height: 150px; max-height:150px; min-width: 100%; max-width: 100%"])}}
			</div>
			<div class="form-group col-xs-12">
				{{Form::label('meta_keywords','Meta Keywords')}}
				{{Form::textarea('meta_keywords','',['class'=>'form-control','title'=>'Meta Keywords of the Product','style'=>"min-height: 150px; max-height:150px; min-width: 100%; max-width: 100%"])}}
			</div>
		</div>
	</div>
</div>
<div class="col-xs-8">
	{{Form::token()}}
	<div class="col-xs-12">
		{{link_to('admin/products','Back',['class'=>'btn btn-danger'])}}	
		<button type="submit" class="btn btn-success">Save</button>
	</div>
</div>
{!! Form::close() !!}

@endsection()