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
	| TinyMCE
	|--------------------------------------------------------------------------
	*/
	tinymce.init({
		selector           : 'textarea.wysi',
		theme              : 'modern',
		width              : '100%',
		menubar            : false,
		entity_encoding    : false,
		plugins            : [
			"advlist anchor autolink autoresize charmap code contextmenu directionality emoticons",
			"fullpage fullscreen hr image insertdatetime legacyoutput link lists media nonbreaking noneditable pagebreak",
			"paste preview save searchreplace tabfocus table visualchars wordcount textcolor"
		],

		toolbar1 : "newdocument undo redo | cut copy paste removeformat | searchreplace | charmap emoticons | table | formatselect fontsizeselect | forecolor backcolor",
		toolbar2 : "bold italic underline strikethrough | hr | superscript subscript | bullist numlist | outdent indent blockquote | alignleft aligncenter alignright alignjustify | link unlink | image media | code fullscreen",

		setup : function(editor)
		{

		}
	});

})