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
	<body class="customBg">
		
		<section>
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="grayBox">
							<div class="row">
								<div class="col-sm-6">
									<label for="banner">Bannière</label>
									<div class="wrapper-select-top">
										<select name="banner" id="banner">
											<option value="">Metro</option>
											<option value="">Option 2</option>
											<option value="">Option 3</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<label for="type_campagne">Type de campagne</label>
									<div class="wrapper-select-top">
										<select name="type_campagne" id="type_campagne">
											<option value="">Réno. Mineures</option>
											<option value="">Option 2</option>
											<option value="">Option 3</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label for="titre-campagne">Titre de la campagne</label>
									<input  type="text" name="titre-campagne" id="titre-campagne" value="Arthur-Sauvé Réno. Mineures"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label for="date-debut">Date de début</label>
									<input class="datechooser" type="text" name="date-debut" id="date-debut" value="06 / 04 / 2015"/>
								</div>
								<div class="col-sm-6">
									<label for="date-fin">Date de fin</label>
									<input class="datechooser" type="text" name="date-fin" id="date-fin" value="15 / 04 / 2015"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label for="non-succursale">Nom de la succursale</label>
									<input type="text" name="non-succursale" id="non-succursale" value="Arthur-Sauvé"/>
								</div>
								<div class="col-sm-6">
									<label for="adresse-succursale">Adresse de la succursale</label>
									<input type="text" name="adresse-succursale" id="adresse-succursale" value="6155, boulevard Arthur-Sauvé"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label for="charge-projet-tgi">Chargée de projet (Tonik Groupimage)</label>
									<div class="wrapper-select-top">
										<select name="charge-projet-tgi" id="charge-projet-tgi">
											<option value="">Anie Lépine</option>
											<option value="">Option 2</option>
											<option value="">Option 3</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<label for="coordonnateur-metro">Coordonnateur (Metro)</label>
									<div class="wrapper-select-top">
										<select name="coordonnateur-metro" id="coordonnateur-metro">
											<option value="">Dominic Audry</option>
											<option value="">Option 2</option>
											<option value="">Option 3</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label for="numero-projet">Numéro de projet</label>
									<input type="text" name="numero-projet" id="numero-projet" value="91339"/>
								</div>
								<div class="col-sm-6">
									<label for="numero-magasin">Numéro de magasin</label>
									<input type="text" name="numero-magasin" id="numero-magasin" value="123456"/>
								</div>
							</div>
							
						</div>
					</div>
					<div class="col-sm-6">
						<div class="grayBox">
							<div class="row">
								<div class="col-sm-12">
									<label for="strategie1">Stratégie</label>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<input class="datechooser" type="text" name="strategie1" id="strategie1" value="15 / 04 / 2015"/>
								</div>
								<div class="col-sm-6 etapes-au">
									<input class="datechooser" type="text" name="strategie2" id="strategie2" value="15 / 04 / 2015"/>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-12">
									<label for="dev-plan-chiffre1">Développement du plan chiffré</label>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<input class="datechooser" type="text" name="dev-plan-chiffre1" id="dev-plan-chiffre1" value="15 / 04 / 2015"/>
								</div>
								<div class="col-sm-6 etapes-au">
									<input class="datechooser" type="text" name="dev-plan-chiffre2" id="dev-plan-chiffre2" value="15 / 04 / 2015"/>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-12">
									<label for="creation1">Création</label>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<input class="datechooser" type="text" name="creation1" id="creation1" value="15 / 04 / 2015"/>
								</div>
								<div class="col-sm-6 etapes-au">
									<input class="datechooser" type="text" name="creation2" id="creation2" value="15 / 04 / 2015"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label for="production1">Production</label>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<input class="datechooser" type="text" name="production1" id="production1" value="15 / 04 / 2015"/>
								</div>
								<div class="col-sm-6 etapes-au">
									<input class="datechooser" type="text" name="production2" id="production2" value="15 / 04 / 2015"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label for="postproduction1">Postproduction</label>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<input class="datechooser" type="text" name="postproduction1" id="postproduction1" value="15 / 04 / 2015"/>
								</div>
								<div class="col-sm-6 etapes-au">
									<input class="datechooser" type="text" name="postproduction2" id="postproduction2" value="15 / 04 / 2015"/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<label for="campagne1">Campagne</label>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<input class="datechooser" type="text" name="campagne1" id="campagne1" value="15 / 04 / 2015"/>
								</div>
								<div class="col-sm-6 etapes-au">
									<input class="datechooser" type="text" name="campagne2" id="campagne2" value="15 / 04 / 2015"/>
								</div>
								</div>
							<div class="row">
								<div class="col-sm-6">
									<label for="date-event">Date de l’événement</label>
									<input class="datechooser" type="text" name="date-event" id="date-event" value="15 / 04 / 2015"/>
								</div>
								<div class="col-sm-6">
									<label for="date-medias">Date médias</label>
									<input class="datechooser" type="text" name="date-medias" id="date-medias" value="15 / 04 / 2015"/>
								</div>
							</div>
							
							
						</div>
					</div>
				</div>
			</div>
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
