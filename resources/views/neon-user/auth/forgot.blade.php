@extends('layouts.auth')
@section('title', 'Forgot')
@section('content')

<div class="login-header login-caret">
		
	<div class="login-content">
		
		<a href="{{ route('home') }}" class="logo">
			<img src="{{ Theme::url('images/membra@2x.png') }}" width="120" alt="" />
		</a>
		
		<p class="description">Oh, so you forgot your password or username?</p>
		
		<!-- progress bar indicator -->
		<div class="login-progressbar-indicator">
			<h3>43%</h3>
			<span>recovering account...</span>
		</div>
	</div>
	
</div>

<div class="login-progressbar">
	<div></div>
</div>

<div class="login-form">
	
	<div class="login-content">
		
		<div class="form-login-error">
			<h3>Recover Unsuccessful</h3>
			<p id="forgot_msg">Oooops...</p>
		</div>
		
		<form method="post" role="form" id="form_forgot_password">

			<div class="form-register-success">
				<i class="fa fa-check"></i>
				<h3>Your account has been semi-recovered</h3><br>
				<p><em>Your password has been changed!</em> Please check your inbox for the temporary password and reactivation of your account.</p>
			</div>

			<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
			
			<div class="form-steps">
					<div class="step current" id="step-1">
			
						<div class="form-group">
							
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</div>
								
								<input type="text" class="form-control" name="email" id="email" placeholder="E-mail" autocomplete="off" />
							</div>
						
						</div>

						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								
								<input type="text" class="form-control" name="birthdate" id="birthdate" placeholder="Date of Birth (DD/MM/YYYY)" data-mask="date" autocomplete="off" />
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block btn-login">
								<i class="fa fa-retweet"></i>
								Recover Account
							</button>
						</div>

				</div>
			</div>
			
		</form>
		
		
		<div class="login-bottom-links">
			
			<a href="{{ route('account-login') }}" class="link">
				<i class="fa fa-lock"></i>
				Return to Login Page
			</a>

			<p><a href="{{ route('account-tos') }}">Terms of Service</a> &middot; <a href="{{ route('account-privacy') }}">Privacy Policy</a></p>
			
		</div>
		
	</div>
	
</div>

@stop

@section('javascript')
	<script src="{{ Theme::url('js/neon-forgotpassword.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.inputmask.bundle.min.js') }}"></script>
@stop