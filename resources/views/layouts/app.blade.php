<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Top Bid</title>

    <!-- Styles -->
    <script type="text/javascript" src={{ asset('js/app.js') }} defer></script>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
	      crossorigin="anonymous">
	    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
	      crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
	      crossorigin="anonymous"></script>
	    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
	      crossorigin="anonymous"></script>
	    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
	      crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="./css/app.css">
	    <script defer src="./js/fontawesome-all.js"></script>
	    <link rel="icon" type="image/png" href="./images/icon.png">
	    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  </head>
  <body>
    
	<nav class="navbar navbar-expand-lg" id="myTopNav">
		<a href="{{route('auction')}}" class="link_logo">
			<img class="topnavLogo" src="./images/icon.png"></img>
		</a>
		<div class="shop_by_category">
			<li class="dropdown">
				<a href="javascript:void(0)" class="dropbtn nav-link dropdown-toggle" style="color: #597ca0ff">Category</a>
				<span class="caret"></span>
				<div class="dropdown-content">
					<div class="row">
						<div class="d-block d-sm-none">
							<a class="dropdown-item" href="#electronics">Electronics</a>
							<a class="dropdown-item" href="#fashion">Fashion</a>
							<a class="dropdown-item" href="#home_garden">Home & Garden</a>
							<a class="dropdown-item" href="#motors">Motors</a>
							<a class="dropdown-item" href="#music">Music</a>
							<a class="dropdown-item" href="#toys">Toys</a>
							<a class="dropdown-item" href="#daily_deals">Daily Deals</a>
							<a class="dropdown-item" href="#sporting">Sporting</a>
							<a class="dropdown-item" href="#others">Others</a>
						</div>
						<div class="col-md-2 d-none d-sm-block">
							<a class="dropdown-item" href="#electronics">Electronics</a>
							<a class="dropdown-item" href="#fashion">Fashion</a>
							<a class="dropdown-item" href="#home_garden">Home & Garden</a>
							<a class="dropdown-item" href="#motors">Motors</a>
							<a class="dropdown-item" href="#music">Music</a>
						</div>
						<div class="col-md-2 d-none d-sm-block" style="padding-left:180px">
							<a class="dropdown-item" href="#toys">Toys</a>
							<a class="dropdown-item" href="#daily_deals">Daily Deals</a>
							<a class="dropdown-item" href="#sporting">Sporting</a>
							<a class="dropdown-item" href="#others">Others</a>
						</div>
					</div>
				</div>
			</li>
		</div>
		<a class="navbar-brand"></a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive"
		 aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse bg-white" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<div class="input-group stylish-input-group" id="search_bar">
						<input type="text" class="form-control" placeholder="Search">
						<span class="search_icon">
							<button class="" type="submit">
								<span class="fa fa-search" style="color:#666666"></span>
							</button>
						</span>
					</div>
				</li>
				@if (!Auth::check())
				<li class="nav-item">
					<a class="nav-link" href="{{ url('login') }}">Sign in</a>
				</li>
				@endif
				@if (Auth::check())
				<li class="nav-item">
					<div class="username">
						<div class="dropdown ">
							<button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
								<img class="img-circle" src="images/perfil_blue.png" style="max-width: 30px; max-height:30px; margin-right:15px; "></img>
								{{Auth::user()->firstname}}
							</button>
							<ul class="dropdown-menu">
								<a href="{{url ('editProfile') }}">Edit Profile</a>
								<a href="{{ url ('logout') }}">Logout</a>
							</ul>
						</div>
					</div>
				</li>
				@endif
				<li class="nav-item">
					<a class="nav-link" href="add_auction.html">Add Auction</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" title="Wish List" href="wishlist.html" style="text-decoration:none; color:#597ca0ff;">
						<i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:25px;"></i>
					</a>
				</li>
			</ul>
		</div>
	</nav>

	<section id="content">
		@yield('content')
	</section>
  	<!-- Footer -->
	<!-- Footer -->
	<footer class="bg-4 text-center">
		<div id="org">
			&nbsp; &nbsp; &nbsp; &copy; &nbsp;2018 &nbsp; TopBid - All Rights Reserved
		</div>
		<div id="orgInfo">
			<li>
				<a href="{{route('faq')}}">FAQ</a>
			</li>
			<li>
				<a href="{{route('about')}}">About</a>
			</li>
			<li>
				<a href="{{route(('contact_us'))}}">Contact Us</a>
			</li>
		</div>
	</footer>
	</body>
</html>
