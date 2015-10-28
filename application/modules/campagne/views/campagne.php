<html>
<head>
	<title>Timeline JSON data</title>

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
		}

		div.red {
			background-color: #FF0000;
			border-color: #A52A2A;
		}

		div.blue {
			background-color: #1E90FF;
			border-color: #0000FF;
		}

		div.orange {
			background-color: #FFA500;
			border-color: #FF4600;
		}

		div.magenta {
			background-color: #A900FF;
			border-color: #800080;
		}
	</style>
	<script type="text/javascript">
		var timeline;
		var data;

		function drawVisualization() {

			var options = {
				'width':  '100%',
                "axisOnTop": true,
                "timeChangeable": false,
                'style': 'box'
			};
			
			for (var campaigns in jsonData)
			{
				console.log(jsonData[campaigns])

				timeline = new links.Timeline(document.getElementById(campaigns), options);

				function onselect() {
					var sel = timeline.getSelection();
					var url = window.location.href;
					var redirect = 'detail/' + timeline.getItem(sel[0].row).id;
					if (url.substr(url.length - 1) != '/') redirect = '/'+redirect;
					window.location.href = url + redirect;
				}

				links.events.addListener(timeline, 'select', onselect);

				timeline.draw(jsonData[campaigns]);
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
