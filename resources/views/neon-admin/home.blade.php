@extends('layouts.main')
@section('title', 'Admin Panel')
   
@section('content')
<div class="row">
	<div class="col-md-12">
		<h1 class="margin-bottom">Admin Panel</small></h1>
		<ol class="breadcrumb 2" >
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li class="active"><strong>Admin</strong></li>
		</ol>
					
		<br />

		<p>Dashboard!</p>
	</div>
</div>
@stop