@extends('layouts.emails.main')
@section('subject') Account Recovery @stop
@section('content') 

It looks as if you have requested to recover your account. Use password and link below to create a new password to recover your account.
If you did not expect this email, you can safely ignore it.<br><br>

Recovery password: {{ $password_temp }}<br><br>
Recovery link: <a href="{{ $link }}">{{ $link }}</a><br><br>

If you have any questions at all, feel free to contact us!<br>

@stop