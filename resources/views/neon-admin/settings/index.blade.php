@extends('layouts.main')
@section('title', 'Settings - Admin')
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Settings</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li class="active"><strong>Settings</strong></li>
		</ol>

		<br />
		
		<p>Settings, hell yeah.</p>

	</div>
</div>
@stop