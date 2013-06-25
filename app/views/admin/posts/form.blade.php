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
	{{ Form::text('slug',  null, array('placeholder' => Lang::get('gorilla.posts.fields.slug'))) }}
	{{ Form::text('publish_date',  null, array('placeholder' => Lang::get('gorilla.posts.fields.publish_date'))) }}

	{{ Form::wysi('content') }}

	<div class="form-actions">
		{{ Form::save() }}
	</div>
{{ Form::close() }}
@stop

@section('bottom_scripts')
<script type="text/javascript">
	$('input[name=title]').focus().select();

	// Build slug
	$('input[name=title]').on('keyup', function(e)
	{
		// Avoid <ENTER>
		var charCode = (e.which) ? e.which : window.event.keyCode;
		if (charCode == 13) return false;

		var title = $(this).val();
		var post_id = {{ $post->exists ? $post->id : 'null' }};

		$.ajax({
			method : 'POST',
			url    : '{{ URL::route("admin_post_slug") }}',
			data   : {
				title: title,
				post_id: post_id,
			},
			beforeSend : function() {
				$('input[type=submit]').attr('disabled', 'disabled');
			},
			success : function(slug) {
				$('input[name=slug]').val(slug);
			},
			complete : function() {
				$('input[type=submit]').removeAttr('disabled');
			}
		});

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