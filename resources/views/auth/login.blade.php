@extends('layouts.base.main')
   
@section('body')
<section class="col-md-9">
   <h1>Login</h1>
   <form action="{{ route('post.login') }}" method="post" accept-charset="utf-8" role="form">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
   
      <!-- print errors -->
      @foreach($errors->all() as $error)
      <p>{{$error}}</p>
      @endforeach
   
         <label for="username">username:</label>
         <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="johndoe123">
   
         <label for="password">Password</label>
         <input type="password" name="password" id="password" value="{{ old('password') }}">
   
         <label>
            <input type="checkbox" name="remember" id="remember" value="1" {{ old('remember') ? 'checked' : '' }}> Remember me
         </label>
   
         <button type="submit">Login</button>
   </form>
</section>
@stop