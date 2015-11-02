$(document).ready(function() {	
	$('.submit').click(function()
	{
		$('#'+$(this).attr('data-value')).submit();
	});
	
	drawVisualization();
	
	$('.campaign').hide();
	$('.timeline_0').show();
	
	$('.collapsious span').click(function() {
		console.log($(this).attr('data-value'));
		$('.campaign').hide(500).parent().removeClass('opened');
		$('.timeline_'+$(this).attr('data-value')).show(500).parent().addClass('opened');
	});
	
	$('.wrapper-select-top').jqTransform({imgPath:'/images/'});
});


function drawVisualization() {
	
	var timeline = [];
	var data;

	var options = {
		'width':  '100%',
		"axisOnTop": true,
		"timeChangeable": false,
		'style': 'box'
	};
	
	function onselect() {
		
		for (var campaigns in jsonData)
		{
			if (timeline[campaigns].getSelection() != undefined)
			{ 
				var sel = timeline[campaigns].getSelection();
			}
			
			for(var i = 0; i < jsonData[campaigns].length; i++)
			{
				 if (sel[i] != undefined && sel[i].row != undefined) 
				 {
					console.log(sel[i].row);
					var url = window.location.href;
					var redirect = 'detail/' + timeline[campaigns].getItem(sel[i].row).id;
					if (url.substr(url.length - 1) != '/') redirect = '/'+redirect;
					window.location.href = url + redirect;
				}
			}
		}
	}
	
	for (var campaigns in jsonData)
	{
		timeline[campaigns] = new links.Timeline(document.getElementById(campaigns), options);
		links.events.addListener(timeline[campaigns], 'select', onselect);
		timeline[campaigns].draw(jsonData[campaigns]);
	}
}
