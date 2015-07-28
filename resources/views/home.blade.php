@extends('layouts.base.main')
@section('title') Home @stop

@section('content')

<section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
	<div class="mdl-card mdl-cell mdl-cell--12-col">
		<div class="mdl-card__supporting-text">
			<h4>Home</h4>
			@if(Auth::guest())
				You are not logged in.
			@else
				You are logged in!
			@endif
		</div>
		<div class="mdl-card__actions">
			<a href="#" class="mdl-button">Read our features</a>
		</div>
	</div>
	<button data-upgraded=",MaterialButton,MaterialRipple" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="btn3">
	<i class="material-icons">more_vert</i>
	<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
	<div class="mdl-menu__container is-upgraded">
		<div class="mdl-menu__outline mdl-menu--bottom-right"></div>
		<ul data-upgraded=",MaterialMenu" class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="btn3">
			<li tabindex="-1" class="mdl-menu__item">Lorem</li>
			<li tabindex="-1" class="mdl-menu__item" disabled="">Ipsum</li>
			<li tabindex="-1" class="mdl-menu__item">Dolor</li>
		</ul>
	</div>
</section>

@endsection
