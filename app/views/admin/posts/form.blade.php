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
					<span class="prefix">@lang('gorilla.posts.fields.tags')</span>
				</div>
				<div class="small-9 large-10 columns">
					{{ Form::text('tags') }}
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
							{{ g_image('img/media-image.jpg') }}
						@endif
					</a>

					<a href="#" class="media-reset label alert @if( ! $post->media_id)hide@endif" data-input="media_id"><i class="foundicon-remove"></i></a>
					<div class="hide">{{ Form::media('media_id') }}</div>
				</div>
			</div>
		</div>
	</div>

	<hr>

	<h5 class="subheader">@lang('gorilla.posts.fields.content')</h5>
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
		var charCode = e.which;

		// Blacklist : '/' (47), '\' (92)
		if (charCode == 47 || charCode == 92) return false;
	});

	/*
	|--------------------------------------------------------------------------
	| TAGS
	|--------------------------------------------------------------------------
	*/
	$('input[name=tags]').select2({
		tags: true,
		width: '100%',
		multiple: true,
		placeholder: "@lang('gorilla.posts.fields.tags')",
		ajax: {
			url      : '{{ URL::route("admin_tags_query") }}',
			dataType : 'json',
			data     : function (term, page) { return { q: term }; },
			results  : function (data, page) { return { results: data }; }
		},
		createSearchChoice: function(term, data) {
			if ($(data).filter(function() {
				return this.text.localeCompare(term) === 0;
			}).length === 0) {
				return { id: term, text: term };
			}
		}
	});

	$('input[name=tags]').select2("data", {{ $post_tags }});

</script>
@stop