@extends('admin.auth.base')

@section('content')
<h4 class="gorilla-sub text-center">@lang('gorilla.auth.reset.title')</h4>

{{ Form::open(array('class' => 'custom')) }}

	{{ Form::alert('alert') }}
	{{ Form::alert('success', 'success') }}

	<div class="row">
		<div class="large-12 columns">
			{{ Form::hidden('token', $token) }}
			{{ Form::email('email', null, array('placeholder' => Lang::get('gorilla.auth.reset.fields.email'))) }}
			{{ Form::password('password', array('placeholder' => Lang::get('gorilla.auth.reset.fields.password'))) }}
			{{ Form::password('password_confirmation', array('placeholder' => Lang::get('gorilla.auth.reset.fields.password_confirmation'))) }}
		</div>
	</div>

	<div class="row">
		<div class="large-12 columns text-center">
			{{ Form::submit(Lang::get('gorilla.auth.reset.actions.reset'), array('class' => 'button small expand')) }}
			<a class="text-muted" href="{{ URL::route('login') }}">@lang('gorilla.auth.reset.actions.login')</a>
		</div>
	</div>

{{ Form::close() }}
@stop

@section('bottom_scripts')
<script type="text/javascript">
	$('input[name=email]').focus().select();
</script>
@stop
