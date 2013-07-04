@extends('admin.base')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="large-6 columns">
			<h3>{{ ucfirst(Lang::get('gorilla.tags.sing')) }}</h3>
		</div>
		<div class="large-6 columns text-right">
			<a href="{{ URL::route('admin_tags') }}" class="button small secondary">{{ Lang::get('gorilla.actions.back') }}</a>
		</div>
	</div>
</div>

{{ Form::alert('alert') }}

{{ Form::model($tag, array('class' => 'custom')) }}
	{{ Form::text('name', null, array('placeholder' => Lang::get('gorilla.tags.fields.name'))) }}

	<div class="form-actions">
		{{ Form::save() }}
	</div>
{{ Form::close() }}
@stop

@section('bottom_scripts')
<script type="text/javascript">
	$('input[name=name]').focus().select();
</script>
@stop