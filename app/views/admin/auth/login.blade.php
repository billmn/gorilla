@extends('admin.auth.base')

@section('content')
<h1>Gorilla <small>#Login</small></h1>

{{ Form::open() }}

	@if (Session::has('errors'))
	<div data-alert class="alert-box">
		{{ Session::get('errors') }}
		<a href="#" class="close">&times;</a>
	</div>
	@endif

	<div class="row">
		<div class="large-12 columns">
			{{ Form::text('username', null, array('placeholder' => 'username')) }}
			{{ Form::password('password', array('placeholder' => 'password')) }}
		</div>
	</div>

	<div class="row">
		<div class="large-12 columns">
			{{ Form::submit('Login', array('class' => 'button small')) }}
		</div>
	</div>
{{ Form::close() }}
@stop