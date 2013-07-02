@extends('admin.base')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="small-4 large-6 columns">
			<h3>{{ ucfirst(Lang::get('gorilla.posts.sing')) }}</h3>
		</div>
		<div class="small-8 large-6 columns text-right">
			<a href="{{ URL::route('admin_posts') }}" class="button small secondary">{{ Lang::get('gorilla.actions.back') }}</a>
		</div>
	</div>
</div>

{{ Form::alert('success', 'notify_confirm') }}
{{ Form::alert('alert') }}

{{ Form::model($post, array('class' => 'post-form custom')) }}

	{{ Form::text('title', null, array('placeholder' => Lang::get('gorilla.posts.fields.title'), 'autocomplete' => 'off')) }}

	<div class="row">
		<div class="large-10 columns">
			<div class="row collapse">
				<div class="small-3 large-2 columns">
					<span class="prefix">@lang('gorilla.posts.fields.slug')</span>
				</div>
				<div class="small-9 large-10 columns">
					{{ Form::text('slug', null, array('placeholder' => Lang::get('gorilla.posts.slug_auto'), 'autocomplete' => 'off')) }}
				</div>
			</div>
			<div class="row collapse">
				<div class="small-3 large-2 columns">
					<span class="prefix">@lang('gorilla.posts.fields.publish_date')</span>
				</div>
				<div class="small-9 large-10 columns">
					<div class="row collapse">
						<div class="small-6 large-6 columns">
							{{ Form::text('publish_date', $post->publish_date->format('Y-m-d'), array('class' => 'datepicker')) }}
						</div>
						<div class="small-6 large-6 columns">
							{{ Form::text('publish_time', $post->publish_date->format('H:i'), array('class' => 'timepicker')) }}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="large-2 columns">
			<div class="row collapse">
				<div class="small-12 large-12 columns text-center">
					<a href="#" class="th media-open" data-input="media_id">
						@if($post->media_id)
							<img src="{{ $post->image->thumb_url }}">
						@else
							{{ image('img/media-image.jpg') }}
						@endif
					</a>

					<a href="#" class="media-reset label alert @if( ! $post->media_id)hide@endif" data-input="media_id"><i class="foundicon-remove"></i></a>

					<div class="hide">{{ Form::media('media_id') }}</div>
				</div>
			</div>
		</div>
	</div>

	<h4 class="subheader">@lang('gorilla.posts.fields.content')</h4>
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

	// Disallow blacklisted characters in Slug field
	$('input[name=slug]').on('keypress', function(e)
	{
		var charCode = (e.which) ? e.which : window.event.keyCode;

		// Blacklist : '/' (47), '\' (92)
		if (charCode == 47 || charCode == 92) return false;
	});

</script>
@stop