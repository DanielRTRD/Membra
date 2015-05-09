<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@section('title') @show - {{ Config::get('rtech.appname') }}</title>

	<!--<link href="{{ asset('/css/app.css') }}" rel="stylesheet">-->
	<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/jasny-bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
	@if(Request::is('login') || Request::is('register'))
		<link href="{{ asset('/css/login.css') }}" rel="stylesheet">
	@endif

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">{{ Config::get('rtech.appname') }}</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ route('login') }}">Login</a></li>
						<li><a href="{{ route('register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ route('profile', Auth::user()->getKey()) }}">Your profile</a></li>
								<hr style="margin:5px;">
								<li><a href="{{ route('logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@if(count($errors) > 0)
		<div class="alert alert-danger alert-fixed-top fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			@if(count($errors) > 1)
				<p><span class="fa fa-exclamation-circle" aria-hidden="true"></span> <strong>Oh snap!</strong> Something went wrong:</p>
				<small>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</small>
			@else
				@foreach ($errors->all() as $error)
					<p><i class="fa fa-exclamation-circle"></i> {{ $error }}</p>
				@endforeach
			@endif
		</div>
	@endif

	@if(Session::has('message'))
		@if(Session::has('messagetype'))
			<div class="alert alert-{{ Session::get('messagetype') }} alert-fixed-top fade in" role="alert">
		@else
			<div class="alert alert-info alert-fixed-top fade in" role="alert">
		@endif
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<p>
				@if(Session::get('messagetype') == 'success')
					<span class="fa fa-info-circle" aria-hidden="true"></span>
				@elseif(Session::get('messagetype') == 'warning')
					<span class="fa fa-exclamation" aria-hidden="true"></span>
				@elseif(Session::get('messagetype') == 'danger')
					<span class="fa fa-exclamation-circle" aria-hidden="true"></span>
				@else
					<span class="fa fa-info-circle" aria-hidden="true"></span>
				@endif
				{{ Session::get('message') }}
			</p>
		</div>
	@endif

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/js/jasny-bootstrap.min.js') }}"></script>
</body>
</html>