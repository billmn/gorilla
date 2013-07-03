@extends('install.base')

@section('content')
{{ Form::open(array('class' => 'custom')) }}

	<h3 class="subheader text-info">{{ Lang::get('gorilla.install.step1.title') }} <small class="text-muted">- {{ Lang::get('gorilla.install.step1.subtitle') }}</small></h3>

	{{ Form::alert('alert') }}

	<div class="row">
		<div class="small-4 large-2 columns">
			<label class="inline">@lang('gorilla.install.step1.fields.host')</label>
		</div>
		<div class="small-8 large-10 columns">
			{{ Form::text('host', 'localhost') }}
		</div>
	</div>
	<div class="row">
		<div class="small-4 large-2 columns">
			<label class="inline">@lang('gorilla.install.step1.fields.name')</label>
		</div>
		<div class="small-8 large-10 columns">
			{{ Form::text('name') }}
		</div>
	</div>
	<div class="row">
		<div class="small-4 large-2 columns">
			<label class="inline">@lang('gorilla.install.step1.fields.username')</label>
		</div>
		<div class="small-8 large-10 columns">
			{{ Form::text('username') }}
		</div>
	</div>
	<div class="row">
		<div class="small-4 large-2 columns">
			<label class="inline">@lang('gorilla.install.step1.fields.password')</label>
		</div>
		<div class="small-8 large-10 columns">
			{{ Form::password('password') }}
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="large-12 columns text-center">
			{{ Form::submit(Lang::get('gorilla.install.next'), array('class' => 'button success small expand')) }}
		</div>
	</div>

{{ Form::close() }}
@stop