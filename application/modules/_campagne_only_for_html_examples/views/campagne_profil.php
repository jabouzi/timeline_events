<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Édition de campagne</title>
		<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/bootstrap-3.3.5.min.css" type="text/css">
		<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/main.css">
		<!--[if lt IE 9]>
			<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="<?php echo site_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="<?php echo site_url(); ?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function(){
				$.datepicker.setDefaults($.datepicker.regional[($('html').attr('lang') == 'en') ? '' : $('html').attr('lang')]);
				$('.datechooser').datepicker();
			});
		</script>
		
	</head>
	<body>
		<div class="header">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="table_wp">
							<div class="table_cell toolboxLogo">
								<img src="/assets/images/toolbox/toolbox.png" alt="" />
							</div>
							<div class="table_cell brandLogo">
								<img src="/assets/images/toolbox/logoBrand.png" alt="" />
							</div>
						</div>
						<ul class="menu-header">
							<li>
								<a href="" class="btn-icon-on-dark-header">
								<svg class="icon-svg calendrierRouge"  viewBox="0 0 32 32" x="48">
									<path fill="#e41b13" d="M29.223 21.14V0H2.733L0 1.518V32h27.978v-2.72H32s-2.777-2.092-2.777-8.14zm-1.84-4.566h-4.79V11.76h4.79v4.814zM15.66 6.208v4.813h-5.355V6.21h5.356zm.79 0h5.355v4.813H16.45V6.21zm-11.876 0h4.942v4.813H4.574V6.21zm0 5.553h4.942v4.82H4.574v-4.82zm0 5.56h4.942v3.83c0 .35.008.68.022.99H4.574v-4.82zm5.73 3.83v-3.83h5.357v3.83c0 .35.01.68.03.99h-5.36c-.01-.31-.02-.64-.02-.98zm0-4.56v-4.82h5.357v4.82h-5.35zm6.145-4.81h5.35v4.82h-5.35v-4.82zm10.93-.74h-4.79V6.21h4.79v4.813zM9.58 22.87c.205 2.45.85 3.867 1.49 4.686H5.94c-.127-.104-.337-.325-.556-.753-.33-.65-.72-1.843-.794-3.933h4.994zm2.54 4.686c-.62-.534-1.5-1.79-1.757-4.685h5.354c.206 2.45.85 3.87 1.49 4.69h-5.09zm6.14 0c-.618-.534-1.498-1.79-1.75-4.685h5.352c.207 2.45.85 3.87 1.49 4.69h-5.09zm-1.8-5.425c-.015-.31-.024-.64-.024-.98v-3.82h5.36v3.83c0 .35.01.68.02.99h-5.35zm6.12-.98v-3.82h4.79v4.57c0 .09 0 .17.002.25h-4.77c-.015-.31-.023-.64-.023-.98zm3.546 9.14H1.84V2.51l.894-.5v20.12c0 6.666 2.778 7.154 2.778 7.154H26.14v.99zm1.84-2.72h-3.56c-.62-.53-1.5-1.79-1.76-4.68h4.74c.084 1.82.403 3.39.954 4.69h-.38z"/>
								</svg>
								<span>Calendrier </span>
								</a>
							</li>
							<li>
								<a href="" class="btn-icon-on-dark-header">
								<svg class="icon-svg profilBlanc" viewBox="0 0 32 32" x="1872">
									<path fill="#FFF" d="M15.722 22.73c-.083 0-.165-.003-.248-.007-1.71-.072-3.098-.876-4.056-1.643-.002.636-.042 1.21-.158 1.51-.36.928-4.44 1.916-6.12 2.206-1.68.29-3.78.928-5.102 4.296-1.32 3.37 32.76 3.37 31.44 0-1.32-3.368-3.42-4.007-5.102-4.296-1.68-.29-5.76-1.28-6.12-2.206-.12-.313-.16-.922-.16-1.59-1.403 1.147-2.87 1.728-4.375 1.728z"/>
									<path fill="#FFF" d="M8.14 10.394s-1.2-.582-.6 1.917 1.678 2.33 1.678 2.33.118 2.09 2.112 4.33c.42.5 2.048 2.23 4.218 2.32 1.595.06 3.187-.77 4.74-2.5 1.847-2.16 1.966-4.14 1.966-4.14s1.082.18 1.68-2.32c.6-2.49-.6-1.91-.6-1.91 1.56-7.9-4.81-10.04-4.81-10.04-1.168-.34-2.086-.39-2.788-.32-.176-.02-.363-.03-.566-.03-.61 0-1.346.09-2.223.35 0 0-6.37 2.15-4.81 10.05z"/>
								</svg>
								<span>Anie Lépine</span>
								</a>
								<li>
									<a href="" class="btn-icon-on-dark-header">
									<svg class="icon-svg deconnexionBlanc"  viewBox="0 0 38 32" x="1200">
										<path fill="#FFF" d="M37.234 16.57l.657-.663-7.79-7.655-1.3 1.326 7.13 7-.01-1.316-7.05 7.115 1.32 1.308 7.05-7.115z"/>
										<path fill="#FFF" d="M34.918 16.75h.93v-1.86h-20.49v1.86h19.56z"/>
										<path fill="#FFF" d="M23.967 2.924c-.57-.37-1.212-.74-1.914-1.084C20.03.847 17.913.248 15.793.248c-3.554 0-7.41 1.334-10.343 3.756C1.99 6.86.008 10.994.008 16.13c0 9.115 7.106 15.818 15.784 15.818 2.225 0 4.366-.58 6.35-1.545.693-.336 1.317-.697 1.866-1.058.335-.22.574-.397.71-.505l-1.165-1.448c-.018.014-.063.05-.133.1-.123.09-.268.192-.435.302-.483.32-1.038.64-1.653.938-1.75.85-3.624 1.358-5.54 1.358-7.674 0-13.925-5.896-13.925-13.958 0-4.578 1.732-8.188 4.767-10.694 2.594-2.142 6.03-3.33 9.16-3.33 1.8 0 3.653.523 5.442 1.4.632.31 1.21.644 1.72.975.177.115.332.22.464.315.076.054.125.09.146.107l1.14-1.468c-.14-.11-.39-.288-.737-.513z"/>
									</svg>
									<span>Déconnexion</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="">Calendrier annuel de campagnes</a></li>
					<li><a href="">Arthur-Sauvé Réno. Mineures</a></li>
					<li><span>Documents</span></li>
				</ul>
				<div class="title-top">
					<h1 class="title-icon-on-white">
						
						
						<svg class="icon-svg icon-profilRouge"  viewBox="0 0 32 32" x="864">
							<path fill="#e41b13" d="M15.722 22.73c-.083 0-.165-.003-.248-.007-1.71-.072-3.098-.876-4.056-1.643-.002.636-.042 1.21-.158 1.51-.36.928-4.44 1.916-6.12 2.206-1.68.29-3.78.928-5.102 4.296-1.32 3.37 32.76 3.37 31.44 0-1.32-3.368-3.42-4.007-5.102-4.296-1.68-.29-5.76-1.28-6.12-2.206-.12-.313-.16-.922-.16-1.59-1.403 1.147-2.87 1.728-4.375 1.728z"/>
							<path fill="#e41b13" d="M8.14 10.394s-1.2-.582-.6 1.917 1.678 2.33 1.678 2.33.118 2.09 2.112 4.33c.42.5 2.048 2.23 4.218 2.32 1.595.06 3.187-.77 4.74-2.5 1.847-2.16 1.966-4.14 1.966-4.14s1.082.18 1.68-2.32c.6-2.49-.6-1.91-.6-1.91 1.56-7.9-4.81-10.04-4.81-10.04-1.168-.34-2.086-.39-2.788-.32-.176-.02-.363-.03-.566-.03-.61 0-1.346.09-2.223.35 0 0-6.37 2.15-4.81 10.05z"/>
						</svg>
						<span>Anie Lépine</span>
					</h1>
					<div class="title-top-btns">
						<a class="btn-icon-on-dark btnPlus back" href="">
						Retour
						</a>
					</div>
				</div>
			</div>
			<section>
				<div class="container">
					<div class="row">
						<form id="campaign" method="post" action="<?php echo site_url('campagne/process_edit_campaign'); ?>">
							<div class="col-sm-6">
								<h2 class="icon-label">
									<svg class="icon-svg icon-identificationRouge" width="50" height="32" viewBox="0 0 50 32" x="624">
										<path fill="#e41b13" d="M0 0l.113 5.814H30.64L30.617 0H0zm.15 18.945l49.358.03V13.06L.15 12.965v5.98zM.15 32h21.756v-5.93H.15V32z"/>
									</svg>
									<span>Identification</span>
								</h2>
								<div class="grayBox">
									<div class="row">
										<div class="col-sm-12">
											<label for="client">Client</label>
											<div class="wrapper-select-top">
												<select name="client" id="client">
													<option value="">Metro</option>
													<option value="">Option 2</option>
													<option value="">Option 3</option>
												</select>
											</div>
										</div>
										
									</div>
									
									<div class="row">
										<div class="col-sm-6">
											<label for="fname">First name</label>
											<input type="text" name="fname" id="fname" value="David"/>
										</div>
										<div class="col-sm-6">
											<label for="lname">Last name</label>
											<input type="text" name="lname" id="lname" value="Carranza"/>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<label for="email">Email</label>
											<input type="text" name="email" id="email" value="kinghdc@hotmail.com"/>
										</div>
										<div class="col-sm-6">
											<label for="status">Status</label>
											<div class="wrapper-select-top">
												<select name="status" id="status">
													<option value="">Not active</option>
													<option value="">Active</option>
												</select>
											</div>
										</div>
									</div>
									
									
								</div>
							</div>
							<div class="col-sm-6">
								<h2 class="icon-label">
									
									<svg class="icon-svg icon-etapesRouge" viewBox="0 0 32 32" width="32px" x="0px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" y="0px"><g id="lock"><path d="M25,13V9c0-4.971-4.029-9-9-9c-4.971,0-9,4.029-9,9v4c-1.657,0-3,1.343-3,3v3v1v2v1c0,4.971,4.029,9,9,9h6   c4.971,0,9-4.029,9-9v-1v-2v-1v-3C28,14.342,26.656,13,25,13z M9,9c0-3.866,3.134-7,7-7c3.866,0,7,3.134,7,7v4h-2V9.002   c0-2.762-2.238-5-5-5c-2.762,0-5,2.238-5,5V13H9V9z M20,9v0.003V13h-8V9.002V9c0-2.209,1.791-4,4-4C18.209,5,20,6.791,20,9z M26,19   v1v2v1c0,3.859-3.141,7-7,7h-6c-3.859,0-7-3.141-7-7v-1v-2v-1v-3c0-0.552,0.448-1,1-1c0.667,0,1.333,0,2,0h14c0.666,0,1.332,0,2,0   c0.551,0,1,0.448,1,1V19z" fill="#333333"/><path d="M16,19c-1.104,0-2,0.895-2,2c0,0.607,0.333,1.76,0.667,2.672c0.272,0.742,0.614,1.326,1.333,1.326   c0.782,0,1.061-0.578,1.334-1.316C17.672,22.768,18,21.609,18,21C18,19.895,17.104,19,16,19z" fill="#333333"/></g></svg>
										<span>Password</span>
									</h2>
									<div class="grayBox">
										<div class="row">
											<div class="col-sm-6">
												<label for="current_password">Current password</label>
												<input type="password" name="current_password" id="current_password" value=""/>
											</div>
											
										</div>
										<div class="row">
											<div class="col-sm-6">
												<label for="new_password">New password</label>
												<input type="password" name="new_password" id="new_password" value=""/>
											</div>
											<div class="col-sm-6">
												<label for="new_password_confirm">Confirm new password</label>
												<input type="password" name="new_password_confirm" id="new_password_confirm" value=""/>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="btn-bottom-hr">
								<hr />
								<a href="" class="btn-icon-on-dark">
								<svg class="icon-svg icon-sauvegarderBlanc" viewBox="0 0 31 32" x="1920">
									<path fill="#FFF" d="M22.652.35v8.792H6.1V.352H0V32h30.493V5.95l-4.68-5.6h-3.16zM4.356 13.54h20.91v13.187H4.356v-13.19z"/>
									<path fill="#FFF" d="M8.712 6.505h11.326V.35H8.712v6.155z"/>
								</svg>
								Sauvegarder
								</a>
							</div>
						</div>
					</section>
					<footer>
						<div class="container">
							<ul class="footer-menu">
								<li> <a href="">Calendrier </a> </li>
								<li> <a href="">Mes paramètres </a></li>
								<li> <a href="">F.A.Q   </a></li>
								<li> <a href=""> Déconnexion </a></li>
								<li> <a href=""> Conditions d’utilisation </a></li>
							</ul>
							<div class="tgi-logo"><a href="" target="_black"><img src="/assets/images/toolbox/tgi-logo.png" alt="" /></a></div>
						</div>
					</footer>
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
				