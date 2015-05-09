@extends('layouts.base.main')
@section('title') {{ $username }}'s Profile @stop
   
@section('content')
	<section class="col-md-9">
		<h1>Profile: {{ $firstname }} {{ $lastname }}</h1>
		<p>Email: {{ $email }}</p>
	</section>
@stop