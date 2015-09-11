
<?php 
	/*if(isset($_POST['registreer']))
	{
		header('location: about');
	}*/

?>

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
		<h1>Login</h1>
	</div>
	<hr>

	{!! Form::open(["url"=>"login"]) !!}

	<div class="container">
		<div class="form-group">
		    {!! Form::label('E-mail') !!}
		    {!! Form::text('email', null, 
		        array('required', 
		              'class'=>'form-control', 
		              'placeholder'=>'Naam')) !!}
		</div>
		

		<div class="form-group">
		    {!! Form::label('Paswoord') !!}
		    {!! Form::text('password', null, 
		        array('required', 
		              'class'=>'form-control', 
		              'placeholder'=>'Paswoord')) !!}
		</div>



		<div class="form-group">
		    {!! Form::submit('Login', ["class"=>"btn btn-primary"]) !!}
		    
		   <!-- {!! Form::submit('Registreer', ["class"=>"btn btn-primary", "name"=>"registreer"]) !!} -->
		</div>


	</div>


	{!! Form::close() !!}
@stop

@section('footer')
<hr>
	<div class="container">
		@include('pages.commonnav')
	</div>
@stop