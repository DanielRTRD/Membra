<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title') - {{ Config::get('rtech.appname') }}</title>

	<!-- Add to homescreen for Chrome on Android -->
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="icon" sizes="192x192" href="img/touch/chrome-touch-icon-192x192.png">

	<!-- Add to homescreen for Safari on iOS -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="Material Design Lite">
	<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">

	<!-- Tile icon for Win8 (144x144 + tile color) -->
	<meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
	<meta name="msapplication-TileColor" content="#3372DF">

	<link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('/css/material.min.css') }}">
	<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.0/material.blue-red.min.css" /> 
	<!-- Custom CSS -->
	<link href="{{ asset('/css/material-extra.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
	@if(Request::is('login') || Request::is('register'))
		<link href="{{ asset('/css/login.css') }}" rel="stylesheet">
	@endif
	<style>
		#view-source {
			position: fixed;
			display: block;
			right: 0;
			bottom: 0;
			margin-right: 40px;
			margin-bottom: 40px;
			z-index: 900;
		}
	</style>
</head>

<body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		<header class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
			<div class="mdl-layout--large-screen-only mdl-layout__header-row"></div>
			<div class="mdl-layout__header-row">
				<h3>{{ Config::get('rtech.appname') }}</h3>
			</div>
			<div class="mdl-layout--large-screen-only mdl-layout__header-row">
			</div>
			<div class="mdl-layout--large-screen-only mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark">
				<a href="#overview" class="mdl-layout__tab is-active">Overview</a>
				<a href="#features" class="mdl-layout__tab">Features</a>
				<a href="#features" class="mdl-layout__tab">Details</a>
				<a href="#features" class="mdl-layout__tab">Technology</a>
				<a href="#features" class="mdl-layout__tab">FAQ</a>
			</div>
		</header>
		<div class="mdl-layout__drawer">
			<span class="mdl-layout-title">{{ Config::get('rtech.appname') }}</span>
			<nav class="mdl-navigation">
				<a href="#overview" class="mdl-navigation__link">Overview</a>
				<a href="#features" class="mdl-navigation__link">Features</a>
				<a href="#features" class="mdl-navigation__link">Details</a>
				<a href="#features" class="mdl-navigation__link">Technology</a>
				<a href="#features" class="mdl-navigation__link">FAQ</a>
			</nav>
		</div>

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
		<main class="mdl-layout__content">
			<div class="mdl-layout__tab-panel is-active" id="overview">
				@yield('content')
			</div>
			<!--<div class="footerwrap">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 text-muted">
							<p>&copy; {{ date("Y") }}, <a href="http://rtrdt.ch/" target="_blank">Retarded Tech</a></p>
							<p class="text-muted"><small>Load time: {{ round((microtime(true) - LARAVEL_START), 3) }}s</small></p>
						</div>
						<div class="col-lg-6">
							<p class="text-right"><em><a href="http://jira.rtrdt.ch/browse/RTUSTWO?selectedTab=com.atlassian.jira.jira-projects-plugin:changelog-panel" target="_blank">{{Config::get('rtech.appname') . ' ' . Config::get('rtech.appversion') . ' ' . Config::get('rtech.appversiontype') }}</a></em>@if(Config::get('app.debug')) - <b><a href="/resetdb" class="text-danger">DEBUG MODE</a></b> @endif</p>
						</div>
					</div>
				</div>
			</div>-->

			<footer class="mdl-mega-footer">
				<div class="mdl-mega-footer--middle-section">
					<div class="mdl-mega-footer--drop-down-section">
						<input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
						<h1 class="mdl-mega-footer--heading">Features</h1>
						<ul class="mdl-mega-footer--link-list">
							<li><a href="#">About</a></li>
							<li><a href="#">Terms</a></li>
							<li><a href="#">Partners</a></li>
							<li><a href="#">Updates</a></li>
						</ul>
					</div>
					<div class="mdl-mega-footer--drop-down-section">
						<input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
						<h1 class="mdl-mega-footer--heading">Details</h1>
						<ul class="mdl-mega-footer--link-list">
							<li><a href="#">Spec</a></li>
							<li><a href="#">Tools</a></li>
							<li><a href="#">Resources</a></li>
						</ul>
					</div>
					<div class="mdl-mega-footer--drop-down-section">
						<input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
						<h1 class="mdl-mega-footer--heading">Technology</h1>
						<ul class="mdl-mega-footer--link-list">
							<li><a href="#">How it works</a></li>
							<li><a href="#">Patterns</a></li>
							<li><a href="#">Usage</a></li>
							<li><a href="#">Products</a></li>
							<li><a href="#">Contracts</a></li>
						</ul>
					</div>
					<div class="mdl-mega-footer--drop-down-section">
						<input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
						<h1 class="mdl-mega-footer--heading">FAQ</h1>
						<ul class="mdl-mega-footer--link-list">
							<li><a href="#">Questions</a></li>
							<li><a href="#">Answers</a></li>
							<li><a href="#">Contact us</a></li>
						</ul>
					</div>
				</div>
				<div class="mdl-mega-footer--bottom-section">
					<div class="mdl-logo">
					More Information
					</div>
					<ul class="mdl-mega-footer--link-list">
						<li><a href="https://developers.google.com/web/starter-kit/">Web Starter Kit</a></li>
						<li><a href="#">Help</a></li>
						<li><a href="#">Privacy and Terms</a></li>
					</ul>
				</div>
			</footer>
		</main>
	</div>
	<script src="{{ asset('/js/material.min.js') }}"></script>
</body>
</html>