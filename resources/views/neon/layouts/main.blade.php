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
						@if(Auth::Guest())
							<li><a href="{{ route('account-login') }}"><span>Login</span></a></li>
						@else
							<li><a href="{{ route('account') }}"><span>Go to Dashboard</span></a></li>
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
	
@yield('content')

<!-- Site Footer -->
<footer class="site-footer">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<p>&copy; {{ date('Y') }}, Infihex</p>
				<p class="text-muted"><small>Load time: {{ round((microtime(true) - LARAVEL_START), 3) }}s</small></p>
			</div>
			<div class="col-md-6 text-right">
				<p><small>
					<a href="http://jira.infihex.com/projects/MEM/issues" target="_blank">{{Config::get('infihex.appname') . ' ' . Config::get('infihex.appversion') . ' ' . Config::get('infihex.appversiontype') }}</a>
					@if(Config::get('app.debug')) <b>(<a href="/resetdb" class="text-danger">DEBUG MODE</a>)</b> @endif by <a href="https://infihex.com/" target="_blank">Infihex</a>
				</small></p>
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
			"positionClass": "toast-bottom-right",
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

		@if(Session::has('message') && Session::has('messagetype'))
			@if(Session::get('messagetype') == 'info')
				toastr.info("{{ Session::get('message') }}", String("{{ Session::get('messagetype') }}").toUpperCase(), opts);
			@elseif(Session::get('messagetype') == 'warning')
				toastr.warning("{{ Session::get('message') }}", String("{{ Session::get('messagetype') }}").toUpperCase(), opts);
			@elseif(Session::get('messagetype') == 'error')
				toastr.error("{{ Session::get('message') }}", String("{{ Session::get('messagetype') }}").toUpperCase(), opts);
			@elseif(Session::get('messagetype') == 'success')
				toastr.success("{{ Session::get('message') }}", String("{{ Session::get('messagetype') }}").toUpperCase(), opts);
			@endif

		@endif

	</script>

	@yield('javascript')

</body>
</html>