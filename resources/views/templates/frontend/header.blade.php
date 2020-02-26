<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>@yield('title')</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="{{ asset('css/frontend/bootstrap.min.css') }}" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="{{ asset('css/frontend/slick.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{ asset('css/frontend/slick-theme.css') }}" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="{{ asset('css/frontend/nouislider.min.css') }}" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="{{ asset('css/frontend/font-awesome.min.css') }}">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{ asset('css/frontend/style.css') }}" />

	<link type="text/css" rel="stylesheet" href="{{ asset('css/frontend/animate.css') }}" />

	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

</head>

<body>
	<!-- HEADER -->
	<header>
		<!-- TOP HEADER -->
		<div id="top-header">
			<div class="container">
				<ul class="header-links pull-left">
					<li><a href="#"><i class="fa fa-phone"></i> 0236.3.779.779</a></li>
					<li><a href="#"><i class="fa fa-envelope-o"></i> tuyensinh@softech.vn</a></li>
					<li><a href="#"><i class="fa fa-map-marker"></i>38 Yen Bai, Hai Chau District, Da Nang City</a></li>
				</ul>
				<ul class="header-links pull-right">
					@auth
					<li><a href="{{ route('admin') }}"><i class="fa fa-user-o"></i>Admin Page</a></li>
					<li class="dropdown"><a href="#">{{ Auth::user()->name }}</a>
						<div class="dropdown-content">
							<a href="#">Profile</a>
							<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
								Logout
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</div>
					</li>
					@else
					<li><a href="{{ route('getLogin') }}"><i class="fa fa-user-o"></i> Login</a></li>
					<li><a href="{{ route('getRegister') }}"><i class="fa fa-user-o"></i> Register</a></li>
					@endauth

				</ul>
			</div>
		</div>
		<!-- /TOP HEADER -->

		<!-- MAIN HEADER -->
		<div id="header">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- LOGO -->
					<div class="col-md-3">
						<div class="header-logo">
							<a href="{{ route('index') }}" class="logo">
								<img src="{{ asset('upload/logo/logo.png') }}" alt="">
							</a>
						</div>
					</div>
					<!-- /LOGO -->

					<!-- SEARCH BAR -->
					<div class="col-md-6">
						<div class="header-search">
							<form role="search" method="get" id="searchform" action="{{route('search')}}">
								<select class="input-select" name="category">
									<option value="all-categories">All Categories</option>
									@for ($i = 0; $i < count($categories); $i++) {{ $i }} @if ($categories[$i]->parent_id===0)
										<option value="{!! $categories[$i]->keyword !!}">{!! $categories[$i]->name !!}</option>
										@endif
										@endfor
								</select>
								<input class="input" type="text" value="" name="search" id="txtSearch" placeholder="Search here">
								<button class="search-btn" id="btnSearch">Search</button>
							</form>
						</div>
					</div>
					<!-- /SEARCH BAR -->

					<!-- ACCOUNT -->
					<div class="col-md-3 clearfix">
						<div class="header-ctn">
							@auth
							<!-- Cart -->
							<div class="dropdown cart_z-index" id="cart">
								<a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									<i class="fa fa-shopping-cart"></i>
									<span class="badge" id="totalProduct">Your Cart</span>
								</a>
								<div class="cart-dropdown" id="cartDetail">

								</div>
							</div>
							<!-- /Cart -->
							@endauth


							<!-- Menu Toogle -->
							<div class="menu-toggle">
								<a href="#">
									<i class="fa fa-bars"></i>
									<span>Menu</span>
								</a>
							</div>
							<!-- /Menu Toogle -->
						</div>
					</div>
					<!-- /ACCOUNT -->
				</div>
				<!-- row -->
			</div>
			<!-- container -->
		</div>
		<!-- /MAIN HEADER -->
	</header>
	<!-- /HEADER -->

	<!-- NAVIGATION -->
	<nav id="navigation">
		<!-- container -->
		<div class="container">
			<!-- responsive-nav -->
			<div id="responsive-nav">
				<!-- NAV -->
				<ul class="main-nav nav navbar-nav">
					<li class="dropdown" id='home'><a href="{{ route('index') }}">Home</a>
					</li>
					@for ($i = 0; $i < count($categories); $i++) @if ($categories[$i]->parent_id === 0)
						<li class="dropdown"><a href="{{ asset('category/'.$categories[$i]->keyword) }}">{{ $categories[$i]->name }}</a>
							<div class="dropdown-content">
								@for ($j = 0; $j < count($categories); $j++) @if ($categories[$j]->parent_id===$categories[$i]->id)
									<a href="{{ route('store',$categories[$j]->keyword) }}">{{ $categories[$j]->name }}</a>
									@endif
									@endfor
							</div>
						</li>
						@endif
						@endfor
				</ul>
				<!-- /NAV -->
			</div>
			<!-- /responsive-nav -->
		</div>
		<!-- /container -->
	</nav>
	<!-- /NAVIGATION -->