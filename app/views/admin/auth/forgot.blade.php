@extends('admin.auth.base')

@section('content')
<h4 class="gorilla-sub text-center">@lang('gorilla.auth.forgot.title')</h4>

{{ Form::open(array('class' => 'custom')) }}

	{{ Form::alert('alert') }}
	{{ Form::alert('success', 'success') }}

	<div class="row">
		<div class="large-12 columns">
			{{ Form::email('email', null, array('placeholder' => Lang::get('gorilla.auth.forgot.fields.email'))) }}
		</div>
	</div>

	<div class="row">
		<div class="large-12 columns text-center">
			{{ Form::submit(Lang::get('gorilla.auth.forgot.actions.forgot'), array('class' => 'button small expand')) }}
			<a class="text-muted" href="{{ URL::route('login') }}">@lang('gorilla.auth.forgot.actions.login')</a>
		</div>
	</div>

{{ Form::close() }}
@stop

@section('bottom_scripts')
<script type="text/javascript">
	$('input[name=email]').focus().select();
</script>
@stop
