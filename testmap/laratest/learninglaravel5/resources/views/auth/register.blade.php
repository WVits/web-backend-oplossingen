@extends('master')

@section('head')
<title>Registreer</title>
@stop


@section('nav')
	<div class="container">
		@include('pages.commonnav')
	</div>
	
@stop


@section('content')
	<div class="container">
		<h1>Registreer</h1>
	</div>
	<hr>
	
	{!! Form::open(["url"=>"users"]) !!}

	<div class="container">
		<div class="form-group">
		    {!! Form::label('Login') !!}
		    {!! Form::text('name', null, 
		        array('required', 
		              'class'=>'form-control', 
		              'placeholder'=>'Kies uw gebruikersnaam')) !!}
		</div>

		<div class="form-group">
		    {!! Form::label('E-mail') !!}
		    {!! Form::text('email', null, 
		        array('required', 
		              'class'=>'form-control', 
		              'placeholder'=>'Geef uw mailadres op')) !!}
		</div>

		<div class="form-group">
		    {!! Form::label('Paswoord') !!}
		    {!! Form::text('password', null, 
		        array('required', 
		              'class'=>'form-control', 
		              'placeholder'=>'Kies uw paswoord')) !!}
		</div>

	


		<div class="form-group">
		   
		    
		    {!! Form::submit('Registreer nieuwe gebruiker', ["class"=>"btn btn-primary", "name" => "registreer"]) !!}

		    <!--{!! Form::submit('Annulleer', ["class"=>"btn btn-primary"]) !!}-->
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