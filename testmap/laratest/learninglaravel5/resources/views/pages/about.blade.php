@extends('master')

@section('head')
<title>Login</title>
@stop


@section('nav')
	<div class="container">
		@include('pages.commonnav')
	</div>
	
@stop


@section('content')
	<div class="container">
		<h1>About</h1>
	</div>
	<hr>
	<div class="container">
		<p>This web-app was created by WVits.</p>
	</div>

	{!! Form::close() !!}
@stop

@section('footer')
<hr>
	<div class="container">
		@include('pages.commonnav')
	</div>
@stop