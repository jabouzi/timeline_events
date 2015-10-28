<html>
<head>
	<title>Timeline JSON data</title>
	
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/timeline.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/json/data.json"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>assets/css/timeline.css">
	 <style type="text/css">
		body {
			font-size: 10pt;
			font-family: verdana, sans, arial, sans-serif;
		}

		div.green {
			background-color: #90EE90;
			border-color: #008000;
			cursor:pointer;
		}

		div.red {
			background-color: #FF0000;
			border-color: #A52A2A;
			cursor:pointer;
		}

		div.blue {
			background-color: #1E90FF;
			border-color: #0000FF;
			cursor:pointer;
		}

		div.orange {
			background-color: #FFA500;
			border-color: #FF4600;
			cursor:pointer;
		}

		div.magenta {
			background-color: #A900FF;
			border-color: #800080;
			cursor:pointer;
		}
	</style>
	<script type="text/javascript">
		var timeline = [];
		var data;

		// Called when the Visualization API is loaded.
		function drawVisualization() {

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

	</script>
</head>

<body onload="drawVisualization();">
<h1>Campagnes</h1>

<?php 
	foreach($banners as $banner) {
		echo '<b>-'.$banner->campaign_banner_name.'</b>';
		echo '<div id="'.$banner->campaign_banner_name.'"></div><br />';
	}
?>

<div id="info"></div>

</body>
</html>
