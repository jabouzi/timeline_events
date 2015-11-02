$(document).ready(function() {	
	$('.submit').click(function()
	{
		$('#'+$(this).attr('data-value')).submit();
	});
});
