@extends('layouts.base.main')
@section('title') Login @stop

@section('content')
<div class="fullscreen_bg" id="fullscreen_bg">
	<div class="container">

		<form action="{{ route('post.login') }}" method="post" accept-charset="utf-8" role="form" class="form-login">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<h1 class="form-login-heading text-muted">Login</h1>
			<input type="text" class="form-control" value="{{ old('username') }}" placeholder="johndoe123" required="" autofocus="" name="username" id="username">
			<input type="password" class="form-control" placeholder="supersecretpassword" required="" name="password" id="password">
			<label>
				<input type="checkbox" name="remember" id="remember" value="1" {{ old('remember') ? 'checked' : '' }}> Remember me
			</label>
			<br><br>
			<button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-sign-in"></i> Login</button>
			<p class="text-center"><br><a href="#">Forgot Your Password?</a></p>
		</form>

	</div>
</div>
@endsection
