@extends('admin.auth.base')

@section('content')
{{ Form::open(array('class' => 'custom')) }}

	{{ Form::alert('alert') }}
	{{ Form::alert('success', 'success') }}

	<div class="row">
		<div class="large-12 columns">
			{{ Form::text('username', null, array('placeholder' => Lang::get('gorilla.auth.login.fields.username'))) }}
			{{ Form::password('password',   array('placeholder' => Lang::get('gorilla.auth.login.fields.password'))) }}

			<label for="remember" id="remember_label">
				<input type="checkbox" id="remember" class="hide">
				<span class="custom checkbox"></span> @lang('gorilla.auth.login.fields.remember')
			</label>
		</div>
	</div>

	<div class="row">
		<div class="large-12 columns text-center">
			{{ Form::submit(Lang::get('gorilla.auth.login.actions.login'), array('class' => 'button small expand')) }}
			<a class="text-muted" href="{{ URL::route('forgot') }}">@lang('gorilla.auth.login.actions.forgot')</a>
		</div>
	</div>

{{ Form::close() }}
@stop

@section('bottom_scripts')
<script type="text/javascript">
	$('input[name=username]').focus().select();
</script>
@stop
