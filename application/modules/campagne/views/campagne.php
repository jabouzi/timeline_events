<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>assets/css/jquery-ui-1.8.4.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>assets/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>assets/css/jquery.ganttView.css" />
	<style type="text/css">
		body {
			font-family: tahoma, verdana, helvetica;
			font-size: 0.8em;
			padding: 10px;
		}
	</style>
	<title>jQuery Gantt</title>
</head>
<body>

	<div id="ganttChart"></div>
	<br/><br/>
	<div id="eventMessage"></div>

	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/date.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery.ganttView.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/json/data.json"></script>
	<script type="text/javascript">
		$(function () {
			$("#ganttChart").ganttView({ 
				data: ganttData,
				slideWidth: 900,
				behavior: {
					draggable: false,
					resizable: false,
					onClick: function (data) { 
						var url = window.location.href;
						console.log(url, data.id);
						url += '/detail/' + data.id;
						window.location.href = url.replace('//', '/');
						var msg = "You clicked on an event: { start: " + data.start.toString("M/d/yyyy") + ", end: " + data.end.toString("M/d/yyyy") + " }";
						$("#eventMessage").text(msg);
					},
					onResize: function (data) { 
						var msg = "You resized an event: { start: " + data.start.toString("M/d/yyyy") + ", end: " + data.end.toString("M/d/yyyy") + " }";
						$("#eventMessage").text(msg);
					},
					onDrag: function (data) { 
						var msg = "You dragged an event: { start: " + data.start.toString("M/d/yyyy") + ", end: " + data.end.toString("M/d/yyyy") + " }";
						$("#eventMessage").text(msg);
					}
				}
			});
			
			// $("#ganttChart").ganttView("setSlideWidth", 600);
		});
	</script>

</body>
</html>

