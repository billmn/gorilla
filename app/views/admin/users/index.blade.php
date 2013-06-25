@extends('admin.base')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="large-6 columns">
			<h3>{{ Lang::get('gorilla.users.title') }} <small>( {{ $users->count() }} )</small></h3>
		</div>
		<div class="large-6 columns text-right">
			<a href="{{ URL::route('admin_user_create') }}" class="button small success">
				{{ Lang::get('gorilla.actions.create') }} {{ Lang::get('gorilla.users.sing') }}
			</a>
		</div>
	</div>
</div>

{{ Form::alert('success', 'notify_confirm') }}

<table class="full-width">
	<thead>
		<tr>
			<th>@lang('gorilla.users.fields.username')</th>
			<th>@lang('gorilla.users.fields.email')</th>
			<td class="text-center">@lang('gorilla.users.fields.enabled')</th>
			<td class="text-center">@lang('gorilla.users.fields.last_login')</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($users as $user)
		<tr>
			<td><a href="{{ URL::route('admin_user_update', array('id' => $user->id)) }}">{{ $user->username }}</a></td>
			<td>
				{{ $user->email }}
			</td>
			<td class="text-center">
				@if ($user->enabled)
					<i class="foundicon-checkmark text-success"></i>
				@else
					<i class="foundicon-remove text-muted"></i>
				@endif
			</td>
			<td class="text-center">
				{{ $user->last_login }}
			</td>
			<td class="actions">
				<a href="{{ URL::route('admin_user_delete', array('id' => $user->id)) }}" class="tiny alert button confirm">@lang('gorilla.actions.delete')</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@stop