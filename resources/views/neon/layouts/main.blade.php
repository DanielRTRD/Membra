<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>@yield('title') - {{ Config::get('infihex.appname') }}</title>

	<link href="{{ Theme::url('css/bootstrap.css') }}" rel="stylesheet">

	<link href="{{ Theme::url('css/font-icons/entypo/css/entypo.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/neon.css') }}" rel="stylesheet">

	<script src="{{ Theme::url('js/jquery-1.11.0.min.js') }}"></script>
	<script>$.noConflict();</script>

	<!--[if lt IE 9]><script src="{{ Theme::url('js/ie8-responsive-file-warning.js') }}"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>

<div class="wrap">
	
<!-- Logo and Navigation -->
<div class="site-header-container container">
	<div class="row">
		<div class="col-md-12">
			<header class="site-header">
				<section class="site-logo">
					<a href="{{ url('/') }}"><img src="{{ Theme::url('images//logo@2x.png') }}" width="120" /></a>
				</section>
				<nav class="site-nav">
					<ul class="main-menu hidden-xs" id="main-menu">
						<li class="active"><a href="{{ url('/') }}"><span>Home</span></a></li>
						<li><a href="{{ route('members') }}"><span><i class="fa fa-users"></i> Members</span></a></li>
						@if(Auth::Guest())
							<li><a href="{{ route('account-login') }}"><span>Login</span></a></li>
						@else

						@endif
					</ul>
					<div class="visible-xs">
						<a href="#" class="menu-trigger"><i class="entypo-menu"></i></a>
					</div>
				</nav>
			</header>
		</div>
	</div>
</div>

<!--
	<nav class="navbar navbar-material-light-blue">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">{{ Config::get('infihex.appname') }}</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="{{ route('members') }}"><i class="fa fa-users"></i> Members</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hello, Guest! <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ route('account-register') }}"><i class="fa fa-pencil"></i> Register</a></li>
								<li class="divider"></li>
								<li><a href="{{ route('account-login') }}"><i class="fa fa-sign-in"></i> Login</a></li>
							</ul>
						</li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hello, {{ Auth::user()->firstname }}! <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ route('account') }}"><span class="fa fa-user"></span> My Account</a></li>
								<li class="divider"></li>
								<li><a href="{{ route('account-change-details') }}"><span class="fa fa-pencil-square-o"></span> Change account details</a></li>
								<li><a href="{{ route('account-change-password') }}"><span class="fa fa-asterisk"></span> Change password</a></li>
								<li><a href="{{ route('account-settings') }}"><span class="fa fa-cog"></span> Settings</a></li>
								<li class="divider"></li>
								<li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
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
-->
	
@yield('content')

<!-- Site Footer -->
<footer class="site-footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<p>&copy; {{ date("Y") }}, <a href="https://infihex.com/" target="_blank">Infihex</a></p>
				<p class="text-muted"><small>Load time: {{ round((microtime(true) - LARAVEL_START), 3) }}s</small></p>
			</div>
			<div class="col-sm-6">
				<p>
					<small>
						<a href="http://jira.infihex.com/projects/MEM/issues" target="_blank">{{Config::get('infihex.appname') . ' ' . Config::get('infihex.appversion') . ' ' . Config::get('infihex.appversiontype') }}</a>
						@if(Config::get('app.debug')) - <b><a href="/resetdb" class="text-danger">DEBUG MODE</a></b> @endif
					</small>
				</p>
			</div>
		</div>
	</div>
</footer>	
</div>


	<!-- Bottom scripts (common) -->
	<script src="{{ Theme::url('js/gsap/main-gsap.js') }}"></script>
	<script src="{{ Theme::url('js/bootstrap.js') }}"></script>
	<script src="{{ Theme::url('js/joinable.js') }}"></script>
	<script src="{{ Theme::url('js/resizeable.js') }}"></script>
	<script src="{{ Theme::url('js/neon-slider.js') }}"></script>
	<script src="{{ Theme::url('js/toastr.js') }}"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="{{ Theme::url('js/neon-custom.js') }}"></script>

	<script type="text/javascript">

		var opts = {
			"closeButton": true,
			"debug": false,
			"positionClass": "toast-top-right",
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};

		@if(Session::has('global') && Session::has('globaltype'))
			@if(Session::get('globaltype') == 'info')
				toastr.info("{{ Session::get('global') }}", String("{{ Session::get('globaltype') }}").toUpperCase(), opts);
			@elseif(Session::get('globaltype') == 'warning')
				toastr.warning("{{ Session::get('global') }}", String("{{ Session::get('globaltype') }}").toUpperCase(), opts);
			@elseif(Session::get('globaltype') == 'error')
				toastr.error("{{ Session::get('global') }}", String("{{ Session::get('globaltype') }}").toUpperCase(), opts);
			@elseif(Session::get('globaltype') == 'success')
				toastr.success("{{ Session::get('global') }}", String("{{ Session::get('globaltype') }}").toUpperCase(), opts);
			@endif

		@endif

	</script>

	@yield('javascript')

</body>
</html>