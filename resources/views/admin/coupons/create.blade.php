@extends('admin.shared.layout')
@section('title','Add Coupon')
@section('content')
	<div class="page-header custom">
		<h1> Add Coupon</h1>
	</div>
	
	<form action="{{url('admin/coupons')}}" method="post" accept-charset="utf-8">
		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="name" class="form-control center" />
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label>Code</label>
					<input type="text" name="code" class="form-control center" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<div class="form-group">
					<label>Discount</label>
					<input type="text" name="discount" class="form-control center"/>
				</div>
			</div>
			<div class="col-xs-4">
				<div class="form-group">
					<label>Discount Type</label>
					<select name="discount_type" class="form-control center">
						<option value=""> --- Select Discount Type --- </option>
						<option value="amount">Amount</option>
						<option value="percentage">Percentage (%)</option>
					</select>
				</div>
			</div>
			<div class="col-xs-4">
				<div class="form-group">
					<label>Minimum Purchase</label>
					<input type="text" name="minimum_purchase" class="form-control center" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<div class="form-group">
					<label>Start Date</label>
					<div class='input-group date' id='start_date'>
	                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                    <input type='text' class="form-control center" name="start_date" />
				    </div>
				</div>
			</div>
			<div class="col-xs-4">
				<div class="form-group">
					<label>End Date</label>
					<div class='input-group date' id='end_date'>
	                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                    <input type='text' class="form-control center" name="end_date" />
				    </div>
				</div>
			</div>
		</div>
		<div class="form-inline">
			<label>Status</label>
			<label>
				<input type="checkbox" name="status" /> Is Active
			</label>
		</div>
		<a href="{{url('admin/coupons')}}" class="btn btn-danger">Back</a>
		<button type="submit" class="btn btn-success">Save</button>
		{{csrf_field()}}
	</form>

	<script>
		$('document').ready(function(){
			$('#start_date').datetimepicker({
				format: 'YYYY-MM-DD'
			});
			$('#end_date').datetimepicker({
				format: 'YYYY-MM-DD'
			});
		});
	</script>	
@endsection