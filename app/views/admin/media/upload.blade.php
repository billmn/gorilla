@extends('admin.base')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="large-6 columns">
			<h3>{{ Lang::get('gorilla.media.upload') }}</h3>
		</div>
		<div class="large-6 columns text-right">
		<a href="{{ URL::route('admin_media') }}" class="button small secondary">{{ Lang::get('gorilla.actions.back') }}</a>
		</div>
	</div>
</div>

<form action="{{ URL::route('admin_media_upload') }}" class="dropzone"></form>

@stop