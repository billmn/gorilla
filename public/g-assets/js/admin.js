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
	| Select 2
	|--------------------------------------------------------------------------
	*/
	$('select').select2();

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
			"paste preview save searchreplace tabfocus table visualchars wordcount textcolor"
		],

		toolbar1 : "newdocument undo redo | cut copy paste removeformat | searchreplace | charmap | table | formatselect | forecolor backcolor | code fullscreen",
		toolbar2 : "bold italic underline strikethrough | hr | superscript subscript blockquote | bullist numlist | alignleft aligncenter alignright alignjustify | link unlink | image media",

		setup : function(editor)
		{

		}
	});

})