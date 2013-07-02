<a class="close-reveal-modal">&#215;</a>

<h4 class="modal-title">@lang('gorilla.media.title')</h4>

<div class="modal-content">
	<ul class="small-block-grid-2 large-block-grid-6">
		@foreach($files as $file)
		<li>
			<div class="media-item" data-url="{{ $file->url }}" data-name="{{ $file->name }}" data-type="{{ $file->isImage() ? 'image' : 'other' }}">
				@if($file->thumb)
					<img src="{{ $file->thumb_url }}" class="image-thumb">
				@else
					{{ image('img/image-fallback.jpg', null, array('class' => 'image-thumb')) }}
				@endif

				<a href="javascript:;" class="media-use"><i class="foundicon-checkmark"></i></a>

				<div class="media-info">
					<div class="media-size round label">{{ format_size($file->size) }}</div>
					<div class="media-name">{{ $file->name }}</div>
				</div>
			</div>
		</li>
		@endforeach
	</ul>
</div>

<script type="text/javascript">
$(function()
{
	// Choose media
	$('.media-use').on('click', function()
	{
		var from  = "{{ Input::get('from') }}";
		var type  = "{{ Input::get('type') }}";
		var html  = '';
		var media = $(this).parents('.media-item:first');

		if (type == 'wysi')
		{
			var editor = parent.tinyMCE.get(from);

			if (media.attr('data-type') == 'image')
			{
				html = '<img src="' + media.attr('data-url') + '" />';
			}
			else
			{
				html = '<a href="' + media.attr('data-url') + '">' + media.attr('data-name') + '</a>';
			}

			editor.selection.setContent(html);
		}
		else
		{
			parent.$('#' + from).val(media.attr('data-url'));
		}

		parent.$('#mediaModal').foundation('reveal', 'close');
	});
})
</script>