@extends('admin.base')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="large-12 columns">
			<h3>{{ Lang::get('gorilla.settings.title') }}</h3>
		</div>
	</div>
</div>

{{ Form::alert('success', 'notify_confirm') }}

{{ Form::model($settings) }}

	<div class="row">
		<div class="large-3 columns">
			<label class="inline">@lang('gorilla.settings.fields.website_title')</label>
		</div>
		<div class="large-9 columns">
			{{ Form::text('website_title') }}
		</div>
	</div>
	<div class="row">
		<div class="large-3 columns">
			<label class="inline">@lang('gorilla.settings.fields.website_slogan')</label>
		</div>
		<div class="large-9 columns">
			{{ Form::text('website_slogan') }}
		</div>
	</div>
	<div class="row">
		<div class="large-3 columns">
			<label class="inline">@lang('gorilla.settings.fields.website_footer')</label>
		</div>
		<div class="large-9 columns">
			{{ Form::textarea('website_footer') }}
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="large-3 columns">
			<label class="inline">@lang('gorilla.settings.fields.timezone')</label>
		</div>
		<div class="large-9 columns">
			{{ Form::select('timezone', $timezones) }}
		</div>
	</div>
	<div class="row">
		<div class="large-3 columns">
			<label class="inline">@lang('gorilla.settings.fields.theme')</label>
		</div>
		<div class="large-9 columns">
			{{ Form::select('theme', $themes) }}
		</div>
	</div>

	<div class="row">
		<div class="large-9 large-offset-3 columns">
			{{ Form::save() }}
		</div>
	</div>

{{ Form::close() }}

@stop