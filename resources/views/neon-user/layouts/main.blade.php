<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<title>@yield('title') - {{ Config::get('infihex.appname') }}</title>

	<link rel="stylesheet" href="{{ Theme::url('js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css') }}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="{{ Theme::url('css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('css/neon-core.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('css/neon-theme.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('css/neon-forms.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('css/custom.css') }}">

	<script src="{{ Theme::url('js/jquery-1.11.0.min.js') }}"></script>
	<script>$.noConflict();</script>

	<!--[if lt IE 9]><script src="{{ Theme::url('js/ie8-responsive-file-warning.js') }}"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body" data-url="http://{{ Config::get('infihex.appname') }}">

<div class="page-container horizontal-menu">

	
	<header class="navbar navbar-fixed-top"><!-- set fixed position by adding class "navbar-fixed-top" -->
		
		<div class="navbar-inner">
		
			<!-- logo -->
			<div class="navbar-brand">
				<a href="#">
					<img src="{{ Theme::url('images/rtusl5@2x.png') }}" width="70" alt="" />
				</a>
			</div>
			
			
			<!-- main menu -->
						
			<ul class="navbar-nav">
				<li>
					<a href="#">
						<i class="entypo-gauge"></i>
						<span class="title">Dashboard</span>
					</a>
					<ul>
						<li><a href="#"><span class="title">Dashboard 1</span></a></li>
						<li><a href="#"><span class="title">Dashboard 2</span></a></li>
						<li><a href="#"><span class="title">Dashboard 3</span></a></li>
					</ul>
				</li>
			</ul>
						
			
			<!-- notifications and other links -->
			<ul class="nav navbar-right pull-right">
				
				<!-- raw links -->
				<li><li><a href="{{ URL::Route('home') }}"><i class="entypo-home"></i>To frontpage</a></li></li>
				<li class="sep"></li>
				<li><a href="{{ URL::Route('logout') }}">Log Out <i class="entypo-logout right"></i></a></li>
				
				
				<!-- mobile only -->
				<li class="visible-xs">	
				
					<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
					<div class="horizontal-mobile-menu visible-xs">
						<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
							<i class="entypo-menu"></i>
						</a>
					</div>
					
				</li>
				
			</ul>
	
		</div>
		
	</header>
	<div class="main-content">

		@yield('content')

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<footer class="main">
						&copy; {{ date('Y') }}, <strong>RTUSL5</strong> by <a href="http://rtrdt.ch/" target="_blank">Retarded Tech</a>
					</footer>
				</div>
			</div>
		</div>

	</div>

	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="{{ Theme::url('js/jvectormap/jquery-jvectormap-1.2.2.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('js/rickshaw/rickshaw.min.css') }}">

	<!-- Bottom scripts (common) -->
	<script src="{{ Theme::url('js/gsap/main-gsap.js') }}"></script>
	<script src="{{ Theme::url('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
	<script src="{{ Theme::url('js/bootstrap.js') }}"></script>
	<script src="{{ Theme::url('js/joinable.js') }}"></script>
	<script src="{{ Theme::url('js/resizeable.js') }}"></script>
	<script src="{{ Theme::url('js/neon-api.js') }}"></script>
	<script src="{{ Theme::url('js/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>


	<!-- Imported scripts on this page -->
	<script src="{{ Theme::url('js/jvectormap/jquery-jvectormap-europe-merc-en.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.sparkline.min.js') }}"></script>
	<script src="{{ Theme::url('js/rickshaw/vendor/d3.v3.js') }}"></script>
	<script src="{{ Theme::url('js/rickshaw/rickshaw.min.js') }}"></script>
	<script src="{{ Theme::url('js/raphael-min.js') }}"></script>
	<script src="{{ Theme::url('js/morris.min.js') }}"></script>
	<script src="{{ Theme::url('js/toastr.js') }}"></script>
	<script src="{{ Theme::url('js/neon-chat.js') }}"></script>


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

</body>
</html>