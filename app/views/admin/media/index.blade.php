@extends('admin.base')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="large-6 columns">
			<h3>{{ Lang::get('gorilla.media.title') }}</h3>
		</div>
		<div class="large-6 columns text-right">
			<a href="{{ URL::route('admin_media_upload') }}" class="button small primary">@lang('gorilla.media.upload')</a>
		</div>
	</div>
</div>
@stop