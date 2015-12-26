@extends('layouts.main')
@section('title', 'My Account')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Welcome back, {{ $firstname }}@if($showname) {{ $lastname }}@endif!</h1>
			<hr>
			<div class="row">
				<div class="col-lg-8">
					
				</div>
				<div class="col-lg-4">
					<div class="row">
						<div class="col-lg-3">
							<img src="{{ $profilepicturesmall }}" class="img-thumbnail">
						</div>
						<div class="col-lg-9">
							<h3>
								<a href="{{ route('user-profile', $username) }}">{{ $firstname }} {{ $lastname }}</a>
								@if($showonline)
									<a href="#" class="user-status is-offline tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="Offline"></a>
									<!-- User statuses available classes "is-online", "is-offline", "is-idle", "is-busy" -->
								@endif
							</h3>
							<p>{{ date_diff(date_create($birthdate), date_create('today'))->y }}@if($location) from {{ $location }}@endif</p>
						</div>
					</div>
					<hr>
					<p>Today is {{ date($userdateformat, time()) }}, and the time is {{ date($usertimeformat, time()) }}.</p>
					<p>
						<strong>Your referral link:</strong><br>
						<input class="form-control" type="text" name="referrallink" id="referrallink" value="{{ Config::get('infihex.appprotocol') }}://{{ Config::get('infihex.appdomain') }}/r/{{ $referral_code }}">
					</p>
					<p>You have referred <strong>{{ 0 }}</strong> user(s).</p>
				</div>
			</div>

		</div>
	</div>
</div>
@stop