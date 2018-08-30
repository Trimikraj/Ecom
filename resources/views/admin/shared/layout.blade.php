<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{url('css/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('css/bootstrap-theme.min.css')}}">
	<link rel="stylesheet" href="{{url('css/bootstrap-datetimepicker.min.css')}}">
	<link rel="stylesheet" href="{{url('font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{url('css/custom.css')}}">

	<script type="text/javascript" src="{{url('js/moment.min.js')}}"></script>
	<script type="text/javascript" src="{{url('js/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{url('js/jquery-ui.min.js')}}"></script>
	<script type="text/javascript" src="{{url('js/bootstrap-datetimepicker.min.js')}}"></script>
	<script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script>

</head>
<body>
	<div class="container">
		<!-- Top Menu -->
		<div>
		    <nav class="navbar navbar-default">
		        <div class="container-fluid">
		            <!-- Brand and toggle get grouped for better mobile display -->
		            <div class="navbar-header">
		                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		                    <span class="sr-only">Toggle navigation</span>
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		                </button>
		                <a class="navbar-brand" href="{{ url('/') }}">Ecom</a>
		            </div>

		            <!-- Collect the nav links, forms, and other content for toggling -->
		            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		                <ul class="nav navbar-nav">
		                    <li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Customers
		                            <span class="caret"></span>
		                        </a>
		                        <ul class="dropdown-menu">
		                            <li class="@if($current == 'customer') active @endif">
		                                <a href="{{url('admin/customers')}}">Customers</a>
		                            </li>
		                            <li class="@if($current == 'customerGroup') active @endif">
		                                <a href="{{url('admin/customers_groups')}}">Customer Groups</a>
		                            </li>
		                        </ul>
		                    </li>
		                    <li class="@if($current == 'category') active @endif">
		                        <a href="{{url('admin/categories')}}">Categories</a>
		                    </li>
		                    <li class="@if($current == 'brand') active @endif">
		                        <a href="{{url('admin/brands')}}">Brands</a>
		                    </li>
		                    <li class="@if($current == 'product') active @endif">
		                        <a href="{{url('admin/products')}}">Products</a>
		                    </li>
		                    <li class="@if($current == 'banner') active @endif">
		                        <a href="{{url('admin/banners')}}">Banners</a>
		                    </li>
		                    <li class="@if($current == 'coupon') active @endif">
		                        <a href="{{url('admin/coupons')}}">Coupons</a>
		                    </li>
		                </ul>
		                <ul class="nav navbar-nav navbar-right">
		                	<!-- Authentication Links -->
	                        @guest
	                            <li><a href="{{ route('login') }}">Login</a></li>
	                            <li><a href="{{ route('register') }}">Register</a></li>
		                        @else
				                    <li class="dropdown">
				                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				                            <span class="glyphicon glyphicon-user"></span>{{ Auth::user()->name }} <span class="caret"></span>
				                        </a>
				                        <ul class="dropdown-menu">
				                    		<li>
		                                        <a href="{{ route('logout') }}"
		                                            onclick="event.preventDefault();
		                                                     document.getElementById('logout-form').submit();">
		                                            Logout
		                                        </a>

		                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                                            {{ csrf_field() }}
		                                        </form>
		                                    </li>
				                        </ul>
				                    </li>
				            @endguest
		                </ul>
		            </div>
		            <!-- /.navbar-collapse -->
		        </div>
		        <!-- /.container-fluid -->
		    </nav>
		</div>

		@yield('content')
	</div>
</body>
</html>