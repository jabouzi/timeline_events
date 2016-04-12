$(document).ready(function() {

	if ($('#campaign_calendar').length)
	{
		drawVisualization2();
	}
	else if ($('#campaign_calendars').length)
	{
		drawVisualization();
	}
	
	//$(".btnPrint").printPage();
});


function drawVisualization() {
	
	var items = {};
	var timeline = {};
	var options = {};
	for (var campaigns in jsonData)
	{
		items[campaigns] = new vis.DataSet(jsonData[campaigns]);
		container = document.getElementById(campaigns);
		var options = {
						orientation: {axis: 'both'}, 
						locale: $("#site_lang").val(), 
						start: new Date(dates[campaigns]['start']), 
						end: addMonths(dates[campaigns]['end'], +3),
						zoomMin: 1000 * 60 * 60 * 24,
						zoomMax: 1000 * 60 * 60 * 24 * 31 * 12
					};
		timeline[campaigns] = new vis.Timeline(container, items[campaigns], options);
		var groups = new vis.DataSet();
		var i = 0;
		for (var gr in groupData[campaigns]) {
			groups.add({id: gr, content: groupData[campaigns][gr]});
			i++;
		}
		timeline[campaigns].setOptions(options);
		timeline[campaigns].setGroups(groups);
	}
	//setTimeout(window.print(), 5000);
	//window.print();
}

function drawVisualization2() {

	var options = {};
	var container = null;
	var groups = new vis.DataSet();
	for (var g = 0; g < groupData.length; g++) {
		groups.add({id: g, content: groupData[g]});
	}
	container = document.getElementById('timeline');
	var items = new vis.DataSet(jsonData);
	var options = { 
					orientation: {axis: 'both'}, 
					locale: $("#site_lang").val(), 
					start: new Date(dates[$('#campaign_name').val()]['start']),  
					end: addMonths(dates[$('#campaign_name').val()]['end'], +3),
				};
	var timeline = new vis.Timeline(container, items, options);
	timeline.setGroups(groups);
	//setTimeout(window.print(), 5000);
	//window.print();
}

function addMonths(date, months) {
  date.setMonth(date.getMonth() + months);
  return date;
}

