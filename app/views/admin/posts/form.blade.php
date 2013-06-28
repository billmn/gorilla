@extends('admin.base')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="large-6 columns">
			<h3>{{ ucfirst(Lang::get('gorilla.posts.sing')) }}</h3>
		</div>
		<div class="large-6 columns text-right">
			<a href="{{ URL::route('admin_posts') }}" class="button small secondary">{{ Lang::get('gorilla.actions.back') }}</a>
		</div>
	</div>
</div>

{{ Form::alert('success', 'notify_confirm') }}
{{ Form::alert('alert') }}

{{ Form::model($post, array('class' => 'custom')) }}
	{{ Form::text('title', null, array('placeholder' => Lang::get('gorilla.posts.fields.title'), 'autocomplete' => 'off')) }}

	<div class="row">
		<div class="large-6 columns">
			<label>@lang('gorilla.posts.fields.slug')</label>
			{{ Form::text('slug', null, array('placeholder' => Lang::get('gorilla.posts.slug_auto'), 'autocomplete' => 'off')) }}
		</div>
		<div class="large-6 columns">
			<label>@lang('gorilla.posts.fields.publish_date')</label>

			<div class="row">
				<div class="large-6 columns">
					{{ Form::text('publish_date', $post->publish_date->format('Y-m-d'), array('class' => 'datepicker')) }}
				</div>
				<div class="large-6 columns">
					{{ Form::text('publish_time', $post->publish_date->format('H:i'), array('class' => 'timepicker')) }}
				</div>
			</div>
		</div>
	</div>

	{{ Form::wysi('content') }}

	<div class="form-actions">
		{{ Form::save() }}
	</div>
{{ Form::close() }}
@stop

@section('bottom_scripts')
<script type="text/javascript">

	$('input[name=title]').focus().select();

	// Force submit ( pickadate cause problems ... )
	$('input').on('keypress', function(e)
	{
		if (e.which == 13) $(this).parents('form:first').submit();
	});

	// Disallow blacklisted chars in Slug field
	$('input[name=slug]').on('keypress', function(e)
	{
		var charCode = (e.which) ? e.which : window.event.keyCode;

		// Chars blacklist : '/' (47), '\' (92)
		if (charCode == 47 || charCode == 92) return false;
	});

</script>
@stop