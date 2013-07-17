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

<!-- Posts that use this Tag -->
<h5 class="subheader">@lang('gorilla.tags.used_by') :</h5>
<table class="full-width">
	<thead>
		<tr>
			<th class="post-title-cell">@lang('gorilla.posts.fields.title')</th>
			<th class="text-center">@lang('gorilla.posts.fields.slug')</th>
			<th class="text-center">@lang('gorilla.posts.fields.publish_date')</th>
	</thead>
	<tbody>
		@foreach($tag->posts()->get() as $post)
		<tr>
			<td>
				<a href="{{ URL::route('admin_post_update', array('id' => $post->id)) }}">{{ $post->title }}</a>
			</td>
			<td class="text-center">
				{{ $post->author->username }}
			</td>
			<td class="text-center">
				{{ $post->publish_date->format('d/m/Y H:i') }}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

@stop

@section('bottom_scripts')
<script type="text/javascript">
	$('input[name=name]').focus().select();
</script>
@stop