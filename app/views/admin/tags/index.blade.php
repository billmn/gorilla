@extends('admin.base')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="large-6 columns">
			<h3>{{ Lang::get('gorilla.tags.title') }} <small>( {{ $tags->count() }} )</small></h3>
		</div>
		<div class="large-6 columns text-right">

		</div>
	</div>
</div>

{{ Form::alert('success', 'notify_confirm') }}

@if ($tags->count())
	<table class="full-width">
		<thead>
			<tr>
				<th>@lang('gorilla.tags.fields.name')</th>
				<th class="text-center">@lang('gorilla.tags.fields.occurrence')</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($tags as $tag)
			<tr>
				<td>
					<a href="{{ URL::route('admin_tag_update', array('name' => $tag->name)) }}">{{ $tag->name }}</a>
				</td>
				<td class="text-center">
					{{ $tag->occurrence }}
				</td>
				<td class="actions">
					<a href="{{ URL::route('admin_tag_delete', array('name' => $tag->name)) }}" class="tiny alert button confirm">@lang('gorilla.actions.delete')</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@else
	<h3 class="text-center subheader">@lang('gorilla.tags.empty')</h3>
@endif

@stop