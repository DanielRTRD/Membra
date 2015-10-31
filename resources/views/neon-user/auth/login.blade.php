@extends('layouts.auth')
@section('title') Login @stop

@section('content')

<div class="login-header login-caret">
		
	<div class="login-content">
		
		<a href="{{ route('home') }}" class="logo">
			<img src="{{ Theme::url('images/rtusl5@2x.png') }}" width="120" alt="" />
		</a>
		
		<p class="description">Your username and password, please...</p>
		
		<!-- progress bar indicator -->
		<div class="login-progressbar-indicator">
			<h3>43%</h3>
			<span>logging in...</span>
		</div>
	</div>
	
</div>

<div class="login-progressbar">
	<div></div>
</div>

<div class="login-form">
	
	<div class="login-content">
		
		<div class="form-login-error">
			<h3>Login Unsuccessful</h3>
			<p id="login_msg">Oooops...</p>
		</div>
		
		<form method="post" role="form" id="form_login">

			<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
			
			<div class="form-group">
				
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-at"></i>
					</div>
					
					<input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" value="{{ old('username') }}" />
				</div>
				
			</div>
			
			<div class="form-group">
				
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-key"></i>
					</div>
					
					<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
				</div>
			
			</div>

			<div class="form-group">
				<label>
					<input type="checkbox" name="remember" id="remember" value="1" {{ old('remember') ? 'checked' : '' }}> Remember me
				</label>
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block btn-login">
					<i class="fa fa-sign-in"></i>
					Login In
				</button>
			</div>
			
		</form>
		
		
		<div class="login-bottom-links">
			
			<a href="{{ route('account-forgotpassword') }}" class="link">Forgot your password?</a>
			
			<br />
			
			<a href="{{ route('account-tos-privacy') }}">Terms of Service &amp; Privacy Policy</a>
			
		</div>
		
	</div>
	
</div>
@endsection

@section('javascript')
	<script src="{{ Theme::url('js/neon-login.js') }}"></script>
@stop