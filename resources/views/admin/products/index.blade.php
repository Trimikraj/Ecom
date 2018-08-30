@extends('admin.shared.layout')
@section('title','Products')
@section('content')
	<div class="page-header custom">
		<h1>Products</h1>
	</div>
	<div class="row">
		<div class="col-xs-4">
			{!! Form::open(['url'=>'admin/products/', 'method'=>'GET']) !!}
				<div class="form-group">
					<input type="text" name="search" class="search" placeholder="Type and press Enter to search..." value="{{$param}}" />
					<a href="{{url('admin/products')}}" class="btn btn-danger sbtn" style="margin-top: 5px" title="Clear search">Clear</a>
				</div>
				{{Form::token()}}
			{!! Form::close() !!}
		</div>
		<div class="pull-right">
			<a class="btn btn-default" title="Filter Search" id="filter"><span class="fa fa-sort"></span> Filter</a>
		</div>
	</div>

	<div class="row" id="filterDiv" style="display: none;">
		{!! Form::open(['url'=>'admin/products', 'method'=>'GET','class'=>'custom']) !!}
			<div class="form-group col-xs-12" style="border: 2px solid #cecece; border-radius: 8px; padding-top: 10px">
				<p>
					{{Form::label('category','Category')}}
				</p>
				<div class="well">
						<?php foreach ($category as $c): ?>
								<label class="checkbox-inline">
									<input type="checkbox" value="{{$c->id}}" name="category[]">{{$c->name}}
								</label>
						<?php endforeach ?>
				</div>
				<p>
					{{Form::label('brand','Brand')}}
				</p>
				<div class="well">
						<?php foreach ($brand as $b): ?>
								<label class="checkbox-inline">
									<input type="checkbox" value="{{$b->id}}" name="brand[]">{{$b->name}}
								</label>
						<?php endforeach ?>
				</div>
				<p>
					{{Form::label('addedDate','Added Date')}}
				</p>
				<div class="well">
					<div class="row">
						<label class="form-group col-xs-3">
								From:
						</label>
						<label class="form-group col-xs-3">
								To:
						</label>
					</div>
					<div class="row">
				        <div class='col-xs-3'>
				            <div class="form-group">
				                <div class='input-group date' id='dateFrom'>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                    <input type='text' class="form-control" />
				                </div>
				            </div>
				        </div>
				        <div class='col-xs-3'>
				            <div class="form-group">
				                <div class='input-group date' id='dateTo'>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                    <input type='text' class="form-control" />
				                </div>
				            </div>
				        </div>
				    </div>
			    </div>
				<p>
					{{Form::label('amount','Price range: ')}}
					<span id="amount" style="border:0; color:#f6931f; font-weight:bold;"></span>
				</p>
				<div class="col-xs-5 well">
					<div class="col-xs-12" id="price"></div>
				</div>
				<div class="well well-sm col-xs-5 pull-right">
					<div class="col-xs-6">
						<label>
							<input type="checkbox" name="isActive"> Is Active
						</label>
					</div>
					<div>
						<label>
							<input type="checkbox" name="isFeatured"> Is Featured
						</label>
					</div>
				</div>
				<div style="clear: both;"></div>
				<div class="modal-footer">
					<div class="col-xs-6">
						<button type="submit" class="btn btn-info">Filter Search</button>
					</div>
					
				</div>
			</div>
		{!! Form::close() !!}
	</div>
	<div class="row">
		<div class="col-xs-4">
			<a class="btn btn-info" title="Bulk Update" id="bulk"><span class="fa fa-sort"></span> Bulk Update</a>
		</div>
		<div class="pull-right">
			<p>
				<a href="{{url('admin/products/create')}}" class="btn btn-info btn-xs">
				<span class="glyphicon glyphicon-plus"></span>
				</a>
			</p>
		</div>
	</div>
	<div class="row" id="bulkDiv" style="display: none;">
		<div class="form-group col-xs-12" style="border: 2px solid #cecece; border-radius: 8px; padding-top: 10px">
		</div>
	</div>
	
<table class="table custom">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Image</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Category</th>
			<th>Brand</th>
			<th>Added Date</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($products as $value): ?>
			<tr>
				<td>{{$value->id}}</td>
				<td>{{$value->name}}</td>
				<td>
					<img src="{{Storage::url($value->image)}}" style="width: 100px;height: 100px" alt="No image available" />
				</td>
				<td>{{$value->quantity}}</td>
				<td>{{$value->price}}</td>
				<td>{{$value->category->name}}</td>
				<td>{{$value->brand->name}}</td>
				<td>{{$value->created_at}}</td>
				<td>
					<?php if ($value->status): ?>
						<label class="label label-success"> Active</label>
					<?php else: ?>
						<label class="label label-danger"> Inactive</label>
					<?php endif ?>
				</td>
				<td>
					{!! Form::open(['url'=>'admin/products/'.$value->id, 'method'=>'DELETE']) !!}
					<a href="{{url('admin/products/'.$value->id.'/edit')}}" class="btn btn-warning btn-xs">
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

<script>
	$(document).ready(function(){
		var filterClicked=true;
		var bulkClicked=true;
		$('#filter').on('click',function(){
			if(filterClicked){
                $(this).addClass('active');
                filterClicked  = false;
            } else {
                $(this).removeClass('active');
                filterClicked  = true;
            }
			$('#filterDiv').toggle();
		});

		$('#bulk').on('click',function(){
			if(bulkClicked){
                $(this).addClass('active');
                bulkClicked  = false;
            } else {
                $(this).removeClass('active');
                bulkClicked  = true;
            }
			$('#bulkDiv').toggle();
		});

		$('#dateFrom').datetimepicker({
			 format: 'YYYY-MM-DD H:m:s'
		});
		$('#dateTo').datetimepicker({
			 format: 'YYYY-MM-DD H:m:s'
		});

		$("#price").slider({
			range: true,
			min: 0,
			max: 5000,
			values: [0, 5000],
			slide: function( event, ui ) {
				$("#amount").html("Rs. " + ui.values[ 0 ] + " - Rs. " + ui.values[ 1 ]);
			}
		});
		$("#amount").html( "Rs. " + $("#price").slider("values", 0) +
			" - Rs. " + $("#price").slider( "values", 1 ) );
	});

</script>
@endsection