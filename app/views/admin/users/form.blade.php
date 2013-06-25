@extends('admin.base')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="large-6 columns">
			<h3>{{ ucfirst(Lang::get('gorilla.users.sing')) }}</h3>
		</div>
		<div class="large-6 columns text-right">
			<a href="{{ URL::route('admin_users') }}" class="button small secondary">{{ Lang::get('gorilla.actions.back') }}</a>
		</div>
	</div>
</div>

{{ Form::alert('alert') }}

{{ Form::model($user, array('class' => 'custom')) }}
	{{ Form::email('email', null, array('placeholder' => Lang::get('gorilla.users.fields.email'))) }}
	{{ Form::text('username', null, array('placeholder' => Lang::get('gorilla.users.fields.username'))) }}
	{{ Form::password('password', array('placeholder' => Lang::get('gorilla.users.fields.password'))) }}
	{{ Form::password('password_confirmation', array('placeholder' => Lang::get('gorilla.users.fields.password_confirmation'))) }}

	<label for="enabled">
		{{ Form::checkbox('enabled', true, null, array('id' => 'enabled', 'class' => 'hide')) }}
		<span class="custom checkbox"></span> @lang('gorilla.users.fields.enabled')
	</label>

	<div class="form-actions">
		{{ Form::save() }}
	</div>
{{ Form::close() }}
@stop

@section('bottom_scripts')
<script type="text/javascript">
	$('input[name=email]').focus().select();
</script>
@stop