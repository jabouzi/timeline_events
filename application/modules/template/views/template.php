<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title><?php echo $page_title; ?> - <?php echo lang('dashboard.title1'); ?></title>
	
	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/bootstrap-3.0.0.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/bootstrap-multiselect.css" type="text/css">
	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/admin.css" type="text/css" media="screen" />

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
	<script src="<?php echo site_url(); ?>assets/js/hideshow.js" type="text/javascript"></script>
	<script src="<?php echo site_url(); ?>assets/js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery.equalHeight.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/bootstrap-3.0.0.min.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/bootstrap-multiselect.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/toolbox.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jscolor/jscolor.js"></script>
	
	<?php if (isset($javascript)) { ?>
		<?php foreach($javascript as $js) { ?>
			<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/<?php echo $js; ?>"></script>
		<?php } ?>
	<?php } ?>
	
	<?php if (isset($json)) { ?>
		<?php foreach($json as $js) { ?>
			<script type="text/javascript" src="<?php echo site_url(); ?>assets/json/<?php echo $js; ?>"></script>
		<?php } ?>
	<?php } ?>

</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><?php echo lang('dashboard.title1'); ?></h1>
			<h1 class="site_title"><a href="/en/campaign"><?php echo 'Voir le site'; ?></h1>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><?php echo $this->session->userdata('user_firstname'); ?> <?php echo $this->session->userdata('user_lastname'); ?>
			&nbsp;&nbsp; <?php echo form_dropdown('lang', $languages, $lang, $redirect); ?>&nbsp;&nbsp; <?php echo anchor('login/logout', lang('login.logout')) ?></p>
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><?php echo anchor('dashboard', lang('dashboard.title2')); ?><div class="breadcrumb_divider"></div> <a class="current"><?php echo $page_title; ?></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<h3><?php echo lang('tonik.title'); ?></h3>
		<ul class="toggle">
			<li class="icn_view_users"><?php echo anchor('tonik/projectmanagers', lang('tonik.projectmanagers')) ?> <span class="add-manager"><?php echo anchor('tonik/newprojectmanager', lang('tonik.newprojectmanager')) ?></span></li>
			<li class="icn_view_users"><?php echo anchor('tonik/campaignssteps', lang('tonik.campaignssteps')) ?></li>
			<li class="icn_view_users"><?php echo anchor('tonik/campaignstype', lang('tonik.campaignstype')) ?></li>
		</ul>		
		<h3><?php echo lang('client.title'); ?></h3>
		<ul class="toggle">
			<?php if ($this->session->userdata('user_permission') <= 2) : ?>
				<li class="icn_add_user"><?php echo anchor('client/newclient', lang('client.new')) ?></li>				
			<?php endif; ?>
			<li class="icn_view_users"><?php echo anchor('client/clients', lang('client.users')) ?></li>
			<li class="icn_view_users"><?php echo anchor('client/banners', lang('client.banners')) ?></li>
			<li class="icn_view_users"><?php echo anchor('client/projectmanagers', lang('client.projectmanagers')) ?></li>
			<li class="icn_view_users"><?php echo anchor('client/campaignssteps', lang('client.campaignssteps')) ?></li>
			<li class="icn_view_users"><?php echo anchor('client/campaignstype', lang('client.campaignstype')) ?></li>
			<!--<li class="icn_profile"><?php echo anchor('client', lang('client.profile')) ?></li>//-->
		</ul>	
		<h3><?php echo lang('user.title'); ?></h3>
		<ul class="toggle">
			<?php if ($this->session->userdata('user_permission') <= 2) : ?>
				<li class="icn_add_user"><?php echo anchor('user/newuser', lang('user.new')) ?></li>
			<?php endif; ?>
			<li class="icn_view_users"><?php echo anchor('user/users', lang('user.users')) ?></li>
			<li class="icn_profile"><?php echo anchor('user', lang('user.profile')) ?></li>
			<?/*<li class="icn_jump_back"><?php echo anchor('login/logout', lang('login.logout')) ?></li>*/?>
		</ul>
		<h3><?php echo lang('admin.title'); ?></h3>
		<ul class="toggle">
			<li class="icn_security"><?php echo anchor('permission', lang('permission.title')) ?></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2015 Admin Toolbox</strong></p>
			<p><a href="<?php echo site_url();?>">Pupliflex</a></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		
	<?php 
		$display_info = 'style="display:none"';
		$display_warning = 'style="display:none"';
		$display_error = 'style="display:none"';
		$display_success = 'style="display:none"';
		if ($info_message) $display_info = '';
		if ($warning_message) $display_warning = '';
		if ($error_message) $display_error = '';
		if ($success_message) $display_success = ''; 
	?>
		
		<h4 <?php echo $display_info; ?> class="alert_info"><?php echo $info_message; ?></h4>
		<h4 <?php echo $display_warning; ?> class="alert_warning"><?php echo $warning_message; ?></h4>
		<h4 <?php echo $display_error; ?> class="alert_error"><?php echo $error_message; ?></h4>
		<h4 <?php echo $display_success; ?> class="alert_success"><?php echo $success_message; ?></h4>
		
		<?php 
		
		//var_dump($admin_widgets);
		
		
		foreach($admin_widgets as $widget => $content)
		{
			echo $content;
		}
		?>

		<div class="clear"></div>
		<input type="hidden" id="hide_text" value="<?php echo lang('admin.hide'); ?>">
		<input type="hidden" id="show_text" value="<?php echo lang('admin.show'); ?>">
</body>

</html>
