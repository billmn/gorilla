$(function()
{
	// Foundation scripts
	$(document).foundation();

	// Confirm dialog
	$(document).on('click', '.confirm', function()
	{
		var answer = confirm(confirm_question);
		if ( ! answer) return false;
	});

	// Select 2
	$('select').select2();

})