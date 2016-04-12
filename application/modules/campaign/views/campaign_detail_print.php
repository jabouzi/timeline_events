<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv='cache-control' content='no-cache'>
		<meta http-equiv='expires' content='0'>
		<meta http-equiv='pragma' content='no-cache'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<? /* <meta name="viewport" content="width=device-width, initial-scale=1"> */ ?>
		<meta name="viewport" content="width=1200" />
		<title>Édition de campagne</title>
		<link rel="icon" href="<?php echo site_url(); ?>assets/images/favicon.ico">
		<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/bootstrap-3.3.5.min.css" type="text/css">
		<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/main.css">
		<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/vis.css">
		<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/campaign_print.css">
		<style type="text/css">
		  div#ttdiv {
			 display: none; 
			
			width: 200px;
			height: 100px;
			border: 1px solid;
			background-color: #ffa;
			position: fixed;
			z-index: 100000;
		  }
		</style>
		<?php if (isset($json)) { ?>
			<?php foreach($json as $js) { ?>
				<script type="text/javascript" src="<?php echo site_url(); ?>assets/json/<?php echo $js; ?>?random=<?php echo uniqid(); ?>"></script>
			<?php } ?>
		<?php } ?>
		
		<?php if (isset($stylesheet)) { ?>
			<?php foreach($stylesheet as $css) { ?>
				<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/<?php echo $css; ?>" type="text/css" media="screen" />
			<?php } ?>
		<?php } ?>
		<!--[if lt IE 9]>
			<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="<?php echo site_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="<?php echo site_url(); ?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/bootstrap-3.0.0.min.js"></script>
		<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery.jqtransform.js"></script>
		<?php if (isset($javascript)) { ?>
		<?php foreach($javascript as $js) { ?>
			<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/<?php echo $js; ?>"></script>
		<?php } ?>
		<?php } ?>
		
		<script src="<?php echo site_url(); ?>assets/js/campaign_print.js" type="text/javascript"></script>
	</head>
	<body>
		<section>
			<div class="container">
				<div class="title-top">
					<h1 class="title-icon-on-white">
						<span><?php echo $campaign_name; ?></span>
					</h1>
				</div>
				<div class="plan-campagne-wp">
					<h2><?= lang('campaign.plan_title')?></h2>
					
				</div>
			</div>
				<div class="container">
					<input type="hidden" id="campaign_calendar" value="0">
					<div class="timeline-wrapper">
						<h3 class="time-line-table"><?= lang('campaign.prod_step_lbl')?></h3>
						<br />
						<div id="timeline"></div>
					</div>
					<h3><?= lang('campaign.budget_lbl')?></h3>
					<div class="budget-wp">
						<div class="twovalues">
							<span class="namebudget">Tonik Groupimage:</span>
							<span class="bugetprice">n/d</span>
						</div>
						<div class="twovalues">
							<span class="namebudget"><?= lang('campaign.budget_other_lbl')?>:</span>
							<span class="bugetprice">n/d</span>
						</div>
						<div class="twovalues bg_right">
							<span class="namebudget"><?= lang('campaign.budget_total_lbl')?>:</span>
							<?php setlocale(LC_MONETARY, $money_format); ?>
							<span class="bugetprice"><?php echo money_format('%.2n', $campaign_budget); ?></span>
						</div>
					</div>
				</div>
			<input type="hidden" id="site_lang" value="<?php echo $lang; ?>">
			<input type="hidden" id="campaign_name" value="<?php echo $campaign_banner_name->campaign_banner_name; ?>">
		</section>
	</body>
</html>
