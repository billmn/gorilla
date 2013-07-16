$(function()
{
	/*
	|--------------------------------------------------------------------------
	| Foundation scripts
	|--------------------------------------------------------------------------
	*/
	$(document).foundation();

	/*
	|--------------------------------------------------------------------------
	| Confirm dialog
	|--------------------------------------------------------------------------
	*/
	$(document).on('click', '.confirm', function()
	{
		var answer = confirm(confirm_question);
		if ( ! answer) return false;
	});

	/*
	|--------------------------------------------------------------------------
	| Moment
	|--------------------------------------------------------------------------
	*/
	moment().lang('it');

	/*
	|--------------------------------------------------------------------------
	| Select 2
	|--------------------------------------------------------------------------
	*/
	$('.select2').select2({
		width: '100%'
	});

	/*
	|--------------------------------------------------------------------------
	| Dropzone
	|--------------------------------------------------------------------------
	*/
	Dropzone.autoDiscover = false;

	$('.dropzone').dropzone({
		uploadMultiple: true,
		parallelUploads: 1
	});

	/*
	|--------------------------------------------------------------------------
	| Pickadate
	|--------------------------------------------------------------------------
	*/
	$('.datepicker').pickadate({
		format: 'yyyy-mm-dd',
		formatSubmit: 'yyyy-mm-dd'
	});

	$('.timepicker').pickatime({
		format: 'H:i',
		formatLabel: 'H:i',
		formatSubmit: 'H:i'
	});

	/*
	|--------------------------------------------------------------------------
	| TinyMCE
	|--------------------------------------------------------------------------
	*/
	tinymce.init({
		selector           : 'textarea.wysi',
		theme              : 'modern',
		width              : '100%',
		menubar            : false,
		entity_encoding    : 'raw',
		plugins            : [
			"advlist anchor autolink autoresize charmap code contextmenu directionality emoticons",
			"fullscreen hr image insertdatetime legacyoutput link lists media nonbreaking noneditable pagebreak",
			"paste preview save searchreplace tabfocus table visualchars wordcount textcolor",
			"_GORILLA_media",
		],

		toolbar1 : "newdocument undo redo | cut copy paste removeformat | searchreplace | charmap | table | formatselect | forecolor backcolor | code fullscreen",
		toolbar2 : "bold italic underline strikethrough | hr | superscript subscript blockquote | bullist numlist | alignleft aligncenter alignright alignjustify | link unlink | image media",
		toolbar3 : "_GORILLA_media",

		setup : function(editor)
		{

		}
	});

	/*
	|--------------------------------------------------------------------------
	| Open Media Modal from a link (eg Click on a thumb)
	|--------------------------------------------------------------------------
	*/
	$('.media-open').on('click', function()
	{
		var show = $(this).attr('data-show') ? $(this).attr('data-show') : 'images';
		open_media_modal($(this).attr('data-input'), 'text', show);
	});

	$('.media-reset').on('click', function()
	{
		$('.media-open img').attr('src', image_fallback_url);
		$('input[name=' + $(this).attr('data-input') + ']').val('');

		$(this).css('visibility', 'hidden');

		return false;
	})
})

/*
|--------------------------------------------------------------------------
| Open Media management in a Modal
|--------------------------------------------------------------------------
*/
function open_media_modal(input_id, input_type, show)
{
	if ( ! show) show = 'all';
	if ( ! input_type) input_type = 'text';

	$('#mediaModal').foundation('reveal', 'open', {
		url: media_modal_url,
		data: {
			from: input_id,
			type: input_type,
			show: show,
		}
	})
}
