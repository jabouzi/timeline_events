<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Login Form</title>
		<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/bootstrap-3.3.5.min.css" type="text/css">
		<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/main.css">
		<!--[if lt IE 9]>
			<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="<?php echo site_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
		
		
	</head>
	<body>
		
		<section class="container">
			<div class="login">
				<h1><?php echo lang('login.title'); ?></h1>
				<p><?php echo lang($message); ?></p>
				<form method="post" action="<?php echo site_url('login/process'); ?>">
					<p><input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" placeholder="<?php echo lang('login.email'); ?>"></p>
					<p><input type="password" name="password" value="<?php echo $this->input->post('password'); ?>" placeholder="<?php echo lang('login.password'); ?>"></p>
					<div>
						<?php echo lang('login.lang'); ?>
						<div class="wrapper-select-top">
							
							<?php echo form_dropdown('lang', $languages, $lang, $redirect); ?>
						</div>
					</div>
					<p class="remember_me">
						<label>
							<input type="checkbox" name="remember_me" id="remember_me" <?php echo $checked; ?> >
							<?php echo lang('login.remember'); ?>
						</label>
					</p>
					<p class="submit"><input type="submit" name="commit" value="<?php echo lang('login.login'); ?>"></p>
				</form>
			</div>
			
			<div class="login-help">
				<p><?php echo lang('login.forget'); ?> <a href="<?php echo site_url('login/password'); ?>"><?php echo lang('login.reset'); ?></a>.</p>
			</div>
		</section>
		<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/functions.js"></script>
		<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/bootstrap-3.0.0.min.js"></script>
		<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery.jqtransform.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$(function(){
					$('.wrapper-select-top').jqTransform({imgPath:'/images/'});
				});
			});
		</script>
	</body>
</html>
