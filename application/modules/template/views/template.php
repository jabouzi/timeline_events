<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />

	<title><?php echo $page_title; ?> - <?php echo lang('dashboard.title1'); ?></title>

	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/bootstrap-3.0.0.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/bootstrap-multiselect.css" type="text/css">
	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/admin.css" type="text/css" media="screen" />
	<style>
/*****************fadein fade out no funciona bien en ie con las imagenes png transparente, mejor poner show(); hide()**********/
/*specifico para cada pagina*/
/*poner .js delante asi aparece el pop up solo si jquery esta activado. Si esta desactivado aparece el texto normal sin pop up*/
/*si quiero rounded corner entonces with fija? experimentar...*/
 div.bubble {
    background: url("images/bg-arrowbox-bottom.png") no-repeat scroll center bottom;
    display: none;
    padding: 0 0 17px;
    position: absolute;
    width: 181px;
}

 div.bubble div.cont {
    background: -moz-linear-gradient(#3B3B3B, #212121) repeat scroll 0 0 transparent;
    border: 1px solid #000000;
    border-radius: 8px 8px 0 0;
    padding: 10px 10px 0;
}

</style>
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
			<h1 class="site_title"><a href="<?php echo site_url(); ?><?php echo $default_lang; ?>/campaign"><?php echo 'Voir le site'; ?></a></h1>
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

		<h3><?php echo lang('manager.title'); ?></h3>
		<ul class="toggle">
			<li class="icn_view_users"><?php echo anchor('manager/projectmanagers', lang('manager.projectmanagers')) ?></li>
			<li class="icn_view_users"><?php echo anchor('manager/newprojectmanager', lang('manager.newprojectmanager')) ?></li>
		</ul>
		<h3><?php echo lang('client.title'); ?></h3>
		<ul class="toggle">
			<?php if ($this->session->userdata('user_permission') == 1) : ?>
				<li class="icn_add_user"><?php echo anchor('client/newclient', lang('client.new')) ?></li>
			<?php endif; ?>
			<li class="icn_view_users"><?php echo anchor('client/clients', lang('client.users')) ?></li>
			<li class="icn_view_users"><?php echo anchor('banner/banners', lang('banner.list')) ?></li>
			<li class="icn_view_users"><?php echo anchor('banner/newbanner', lang('banner.add')) ?></li>
			<li class="icn_view_users"><?php echo anchor('campaign/steps', lang('client.campaignssteps')) ?></li>
			<li class="icn_view_users"><?php echo anchor('campaign/types', lang('client.campaignstype')) ?></li>
			<li class="icn_view_users"><?php echo anchor('campaign/status', lang('client.campaignstatus')) ?></li>
			<!--<li class="icn_profile"><?php echo anchor('client', lang('client.profile')) ?></li>//-->
		</ul>
		<h3><?php echo lang('user.title'); ?></h3>
		<ul class="toggle">
			<?php if ($this->session->userdata('user_permission') == 1) : ?>
				<li class="icn_add_user"><?php echo anchor('user/newuser', lang('user.new')) ?></li>
			<?php endif; ?>
			<li class="icn_view_users"><?php echo anchor('user/users', lang('user.users')) ?></li>
			<li class="icn_profile"><?php echo anchor('user/profile', lang('user.profile')) ?></li>
		</ul>
		<h3><?php echo lang('admin.title'); ?></h3>
		<ul class="toggle">
			<li class="icn_tags"><?php echo anchor('language/languages', lang('language.title')) ?></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; <?php echo date('Y'); ?> Admin Toolbox v.1</strong></p>
			<p><a href="<?php echo site_url();?>">Pupliflex</a></p>
			<br /><br />
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
		
		<form id="change_lang" action="<?php echo site_url('template/change_language'); ?>" method="post">
			<input type="hidden" name="current_uri" value="<?php echo current_url(); ?>">
			<?php 
				echo '<p>'.lang('language.site'); 
				echo form_dropdown('site_language', $site_languages,  $current_lang, $submit);
				echo '</p>';
			?>
		</form>
		
		<?php
		
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
