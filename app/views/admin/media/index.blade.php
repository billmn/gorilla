@extends('admin.base')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="large-6 columns">
			<h3>{{ Lang::get('gorilla.media.title') }}</h3>
		</div>
		<div class="large-6 columns text-right">
			<a href="{{ URL::route('admin_media_upload') }}" class="upload button small primary">@lang('gorilla.media.upload')</a>
		</div>
	</div>
</div>

@if ($files->count())
	<ul class="small-block-grid-2 large-block-grid-6">
		@foreach($files as $file)
		<li>
			<div class="media-item">
				@if($file->thumb)
					<img src="{{ $file->thumb_url }}" class="image-thumb">
				@else
					{{ g_image('img/media-doc.jpg', null, array('class' => 'image-thumb')) }}
				@endif

				<a href="{{ URL::route('admin_media_delete', array('id' => $file->id)) }}" class="confirm media-delete label alert"><i class="foundicon-remove"></i></a>

				<div class="media-info">
					<div class="media-size round label">{{ format_size($file->size) }}</div>
					<div class="media-name">{{ $file->name }}</div>
				</div>
			</div>
		</li>
		@endforeach
	</ul>
@else
	<h3 class="text-center subheader">@lang('gorilla.media.empty')</h3>
@endif

@stop