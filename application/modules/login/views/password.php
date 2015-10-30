<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">






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
	<body class="customBg">
		<section class="container">
			<form  name="formLogin" method="post" action="<?php echo site_url('login/processpwd'); ?>">
				<div class="login_wp">
					<div class="login">
						<div class="table_wp">
							<div class="table_cell toolboxLogo">
								<img src="/assets/images/toolbox/toolbox.png" alt="" />
							</div>
							<div class="table_cell brandLogo">
								<img src="/assets/images/toolbox/logoBrand.png" alt="" />
							</div>
						</div>
						<p><?php echo lang($message); ?></p>
						<div class="loginBox">
							<label for="email"><?php echo lang('login.email'); ?></label>
							<input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" placeholder="<?php echo lang('login.email'); ?>">
							
							
							<label>	<?php echo lang('login.lang'); ?></label>
							<div class="wrapper-select-top">
								<?php echo form_dropdown('lang', $languages, $lang, $redirect); ?>
							</div>
							
						</div>
					</div>
					<div class="loginBtnsBox">
						
						<a class="btn_login_box" href="<?php echo site_url('login'); ?>"><?php echo lang('login.back.login'); ?></a>
						<input class="btn_login_box btnLogin" type="submit" name="commit" value="<?php echo lang('login.retrieve.password'); ?>">
					</div>
				</div>
			</form>
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
