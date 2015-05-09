@extends('layout.main')
@section('title', 'My Account')
@section('content')

<div class="row">
	<div class="col-md-12">

        <h2>My Account</h2>
        <hr>
		<div class="row">
			<div class="col-lg-3">
				@include('layouts.base.account-sidebar')
			</div>
			<div class="col-lg-9">
				<h3>Welcome back, {{ $firstname }}!</h3>
				<div class="row">
					<div class="col-lg-6">
						<p>Today is {!! $getUserDateFormat  !!}, and the time is {{ $getUserDateFormat  }}.</p>
					</div>
					<div class="col-lg-6">
						<p>
							<strong>Your referral link:</strong><br>
							<input class="form-control" type="text" name="referrallink" id="referrallink" value="http://pkmn.cards/r/{{$user->referral_code}}">
						</p>
						<p>You have referred <strong></strong> user(s).</p>
					</div>
				</div>
				
			</div>
		</div>

	</div>
</div>

@stop