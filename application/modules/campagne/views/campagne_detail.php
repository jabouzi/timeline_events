<html>
<head>
	<title>Timeline JSON data</title>

	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/timeline.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/json/data_<?php echo $campaign_id; ?>.json"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>assets/css/timeline.css">
	 <style type="text/css">
		body {
			font-size: 10pt;
			font-family: verdana, sans, arial, sans-serif;
		}

		div.default {
			cursor:pointer;
		}
		
	</style>
	<script type="text/javascript">
		var timeline;
		var data;

		// Called when the Visualization API is loaded.
		function drawVisualization() {

			var options = {
				'width':  '100%',
                "axisOnTop": true,
                "timeChangeable": false,
                'style': 'box'
			};

			// Instantiate our timeline object.
			timeline = new links.Timeline(document.getElementById('mytimeline'), options);

			timeline.draw(jsonData);
		}

	</script>
</head>

<body onload="drawVisualization();">
<h1><?php echo $campaign_name; ?></h1>

<?php echo '<div id="mytimeline"></div>'; ?>

<div id="info"></div>

</body>
</html>
