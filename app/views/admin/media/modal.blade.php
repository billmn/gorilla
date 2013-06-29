<a class="close-reveal-modal">&#215;</a>

<h4 class="modal-title">@lang('gorilla.media.title')</h4>

<div class="modal-content">
	<ul class="small-block-grid-2 large-block-grid-6">
		@foreach($files as $file)
		<li>
			<div class="media-item">
				@if($file->thumb)
					<img src="{{ $file->thumb_url }}" class="image-thumb">
				@else
					{{ image('img/image-fallback.jpg', null, array('class' => 'image-thumb')) }}
				@endif

				<a href="{{ URL::route('admin_media_delete', array('id' => $file->id)) }}" class="media-use"><i class="foundicon-checkmark"></i></a>

				<div class="media-info">
					<div class="media-size round label">{{ format_size($file->size) }}</div>
					<div class="media-name">{{ $file->name }}</div>
				</div>
			</div>
		</li>
		@endforeach
	</ul>
</div>