<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Login Form</title>
<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/login.css">
<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="container">
	<div class="login">
		<h1><?php echo lang('login.retrieve.password'); ?></h1>
		<p><?php echo lang($message); ?></p>
		<form method="post" action="<?php echo site_url('login/processpwd'); ?>">
			<p><input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" placeholder="<?php echo lang('login.email'); ?>"></p>
			<p>
				<?php echo lang('login.lang'); ?>
				<?php echo form_dropdown('lang', $languages, $lang, $redirect); ?>
			</p>
		<p class="submit"><input type="submit" name="commit" value="<?php echo lang('login.retrieve.password'); ?>"></p>
		</form>
	</div>

	<div class="login-help">
		<p><a href="<?php echo site_url('login'); ?>"><?php echo lang('login.back.login'); ?></a>.</p>
	</div>
  </section>
</body>
</html>
