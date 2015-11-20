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
						
							<svg class="icon-svg icon-documentsRouge"  viewBox="0 0 33 32" x="288">
    <path fill="#e41b13" d="M14.994.013v1.292h14.354V26.67h2.93V.012H14.995z"/>
    <path fill="#e41b13" d="M6.652 5.317L.115 11.233v20.74h23.372V5.317H6.653zm.94 1.32v5.508H1.508l6.086-5.508z"/>
    <path fill="#e41b13" d="M10.635 2.665v1.292H24.99V29.32h2.855V2.666h-17.21z"/>
  </svg>
						<span>Arthur-Sauvé Réno. Mineures </span>
					</h1>
					<div class="title-top-btns">
						<a href="" class="btn-icon-on-dark btnPlus">
						Ajouter un document
						</a>
					</div>
				</div>
			</div>
			<section>
				<div class="container">
					<table class="toolboxTbDoc">
						<tbody>
							<tr>
								<td class="doc_file"> 
									<svg id="icon-powerpoint"  viewBox="0 0 29 32" x="2160">
										<path fill="#444" d="M20.635 15.933c1.75-.03 3.367.677 4.68 1.634l-4.54 6.32 7.59 2.384c-.998 3.18-3.94 5.51-7.452 5.57-4.392.08-8.015-3.42-8.092-7.81s3.43-8.01 7.82-8.09zm-15.908 6.93h5.682v2.274H4.72v-2.273zm0-3.408h6.818v2.273H4.727v-2.273zm0-1.137v-2.273h7.955v2.273H4.727z"/>
										<path fill="#444" d="M.182.136H16.66l8.52 8.524v7.066l-2.273-1.172V11.5h-9.092V2.41H2.455v25h8.69c.243.82.617 1.586 1.095 2.273H.18V.138zm15.91 2.84v6.25h6.25l-6.25-6.25z"/>
									</svg>
									<span class="text-powerpoint">Plan_média.ppt</span>
									
								</td>
								<td class="doc_date"> 
									14 avril 
								</td>
								<td class="doc_weight"> 
									13 mb
								</td>
								<td class="doc_name_person"> 
									Anie Lépine
								</td>
								<td class="doc_download"> 
									<a href="" target="_blank">
									<svg id="icon-download" viewBox="0 0 32 32" x="1392">
										<path fill="#FFF" d="M8.282 0v11.87H0L16 32l16-20.13h-8.282V0H8.282z"/>
									</svg>
									<span class="text-icon-download">  Télécharger</span></a>
								</td>
								<td class="doc_remove"> 
									<a href="">
									<svg id="icon-supprimer" viewBox="0 0 32 32" x="960">
										<path class="supprimer_bg" fill="#e41b13" d="M32 16c0 8.837-7.163 16-16 16S0 24.837 0 16 7.163 0 16 0s16 7.163 16 16z"/>
										<path fill="#fff" d="M9.6 17.92h14.72v-3.84H7.68v3.84H9.6z"/>
									</svg>
									</a>
								</td>
							</tr>
							<tr>
								<td class="doc_file"> 
									<svg id="icon-pdf"  viewBox="0 0 24 32" x="2016">
										<path fill="#444" d="M0 31.288C0 32 .71 32 .71 32h22.045s.71 0 .71-.71V6.4l-6.4-6.4H.71S0 0 0 .71v30.58zm1.067-1.024V1.734c0-.667.647-.667.647-.667H16v5.69c0 .71.71.71.71.71h5.69v22.798c0 .668-.647.668-.647.668H1.715s-.647 0-.647-.67zm9.392-13.47l.2-.51c-.69-2.633-1.11-4.746-.74-6.112.1-.356.51-.572.95-.572l.27.004c.65-.01.93.76.97 1.058.05.497-.18 1.34-.18 1.34 0-.34.01-.89-.2-1.364-.25-.548-.49-.876-.71-.928-.11.072-.22.222-.25.51-.08.402-.1.91-.1 1.173 0 .926.18 2.15.54 3.41.07-.196.13-.384.17-.56l.54-2.11s-.12 2.442-.28 3.18l-.12.47c.59 1.65 1.54 3.125 2.68 4.186.44.41 1.01.75 1.54 1.06 1.17-.17 2.25-.25 3.15-.24 1.19.01 2.06.19 2.42.54.17.17.24.37.26.6 0 .09-.04.3-.05.35.01-.07.01-.38-.95-.69-.76-.24-2.17-.24-3.86-.06 1.96.95 3.864 1.43 4.47 1.15.15-.07.33-.32.33-.32s-.11.48-.19.6c-.1.13-.29.27-.47.32-.95.25-3.44-.34-5.6-1.58-2.42.36-5.08 1.01-7.21 1.71-2.094 3.67-3.668 5.35-4.948 4.71l-.47-.24c-.19-.11-.22-.38-.18-.59.15-.73 1.063-1.83 2.9-2.93.2-.12 1.08-.59 1.08-.59s-.65.63-.805.75c-1.47 1.2-2.55 2.71-2.527 3.3 1.26-.13 3.13-2.667 5.53-7.37.58-1.14 1.248-2.426 1.778-3.72zm-1.02 4.108c-.4.756-.8 1.457-1.16 2.1 2-.84 4.16-1.376 6.21-1.758-.28-.19-.55-.392-.8-.606-1.14-.957-2-2.15-2.62-3.408-.4 1.068-.87 2.202-1.65 3.672z"/>
									</svg>
									<span class="text-pdf">Rapport_Nielsen.pdf</span>
									
								</td>
								<td class="doc_date"> 
									4 avril 
								</td>
								<td class="doc_weight"> 
									22 mb
								</td>
								<td class="doc_name_person"> 
									Anie Lépine
								</td>
								<td class="doc_download"> 
									<a href="" target="_blank">
									<svg id="icon-download" viewBox="0 0 32 32" x="1392">
										<path fill="#FFF" d="M8.282 0v11.87H0L16 32l16-20.13h-8.282V0H8.282z"/>
									</svg>
									<span class="text-icon-download">  Télécharger</span></a>
								</td>
								<td class="doc_remove"> 
									<a href="">
									<svg id="icon-supprimer" viewBox="0 0 32 32" x="960">
										<path class="supprimer_bg" fill="#e41b13" d="M32 16c0 8.837-7.163 16-16 16S0 24.837 0 16 7.163 0 16 0s16 7.163 16 16z"/>
										<path fill="#fff" d="M9.6 17.92h14.72v-3.84H7.68v3.84H9.6z"/>
									</svg>
									</a>
									</td>
							</tr>
							<tr>
								<td class="doc_file"> 
									<svg id="icon-powerpoint"  viewBox="0 0 29 32" x="2160">
										<path fill="#444" d="M20.635 15.933c1.75-.03 3.367.677 4.68 1.634l-4.54 6.32 7.59 2.384c-.998 3.18-3.94 5.51-7.452 5.57-4.392.08-8.015-3.42-8.092-7.81s3.43-8.01 7.82-8.09zm-15.908 6.93h5.682v2.274H4.72v-2.273zm0-3.408h6.818v2.273H4.727v-2.273zm0-1.137v-2.273h7.955v2.273H4.727z"/>
										<path fill="#444" d="M.182.136H16.66l8.52 8.524v7.066l-2.273-1.172V11.5h-9.092V2.41H2.455v25h8.69c.243.82.617 1.586 1.095 2.273H.18V.138zm15.91 2.84v6.25h6.25l-6.25-6.25z"/>
									</svg>
									<span class="text-powerpoint">Rapport_clientèle.ppt</span>
									
								</td>
								<td class="doc_date"> 
									14 avril 
								</td>
								<td class="doc_weight"> 
									13 mb
								</td>
								<td class="doc_name_person"> 
									Anie Lépine
								</td>
								<td class="doc_download"> 
									<a href="" target="_blank">
									<svg id="icon-download" viewBox="0 0 32 32" x="1392">
										<path fill="#FFF" d="M8.282 0v11.87H0L16 32l16-20.13h-8.282V0H8.282z"/>
									</svg>
									<span class="text-icon-download">  Télécharger</span></a>
								</td>
								<td class="doc_remove"> 
									<a href="">
									<svg id="icon-supprimer" viewBox="0 0 32 32" x="960">
										<path class="supprimer_bg" fill="#e41b13" d="M32 16c0 8.837-7.163 16-16 16S0 24.837 0 16 7.163 0 16 0s16 7.163 16 16z"/>
										<path fill="#fff" d="M9.6 17.92h14.72v-3.84H7.68v3.84H9.6z"/>
									</svg>
									</a>
								</td>
							</tr>
							<tr>
								<td class="doc_file"> 
									<svg id="icon-pdf"  viewBox="0 0 24 32" x="2016">
										<path fill="#444" d="M0 31.288C0 32 .71 32 .71 32h22.045s.71 0 .71-.71V6.4l-6.4-6.4H.71S0 0 0 .71v30.58zm1.067-1.024V1.734c0-.667.647-.667.647-.667H16v5.69c0 .71.71.71.71.71h5.69v22.798c0 .668-.647.668-.647.668H1.715s-.647 0-.647-.67zm9.392-13.47l.2-.51c-.69-2.633-1.11-4.746-.74-6.112.1-.356.51-.572.95-.572l.27.004c.65-.01.93.76.97 1.058.05.497-.18 1.34-.18 1.34 0-.34.01-.89-.2-1.364-.25-.548-.49-.876-.71-.928-.11.072-.22.222-.25.51-.08.402-.1.91-.1 1.173 0 .926.18 2.15.54 3.41.07-.196.13-.384.17-.56l.54-2.11s-.12 2.442-.28 3.18l-.12.47c.59 1.65 1.54 3.125 2.68 4.186.44.41 1.01.75 1.54 1.06 1.17-.17 2.25-.25 3.15-.24 1.19.01 2.06.19 2.42.54.17.17.24.37.26.6 0 .09-.04.3-.05.35.01-.07.01-.38-.95-.69-.76-.24-2.17-.24-3.86-.06 1.96.95 3.864 1.43 4.47 1.15.15-.07.33-.32.33-.32s-.11.48-.19.6c-.1.13-.29.27-.47.32-.95.25-3.44-.34-5.6-1.58-2.42.36-5.08 1.01-7.21 1.71-2.094 3.67-3.668 5.35-4.948 4.71l-.47-.24c-.19-.11-.22-.38-.18-.59.15-.73 1.063-1.83 2.9-2.93.2-.12 1.08-.59 1.08-.59s-.65.63-.805.75c-1.47 1.2-2.55 2.71-2.527 3.3 1.26-.13 3.13-2.667 5.53-7.37.58-1.14 1.248-2.426 1.778-3.72zm-1.02 4.108c-.4.756-.8 1.457-1.16 2.1 2-.84 4.16-1.376 6.21-1.758-.28-.19-.55-.392-.8-.606-1.14-.957-2-2.15-2.62-3.408-.4 1.068-.87 2.202-1.65 3.672z"/>
									</svg>
									<span class="text-pdf">Présentation_intégrée.pdf</span>
									
								</td>
								<td class="doc_date"> 
									4 avril 
								</td>
								<td class="doc_weight"> 
									22 mb
								</td>
								<td class="doc_name_person"> 
									Fannie Théroux
								</td>
								<td class="doc_download"> 
									<a href="" target="_blank">
									<svg id="icon-download" viewBox="0 0 32 32" x="1392">
										<path fill="#FFF" d="M8.282 0v11.87H0L16 32l16-20.13h-8.282V0H8.282z"/>
									</svg>
									<span class="text-icon-download">  Télécharger</span></a>
								</td>
								<td class="doc_remove"> 
									<a href="">
									<svg id="icon-supprimer" viewBox="0 0 32 32" x="960">
										<path class="supprimer_bg" fill="#e41b13" d="M32 16c0 8.837-7.163 16-16 16S0 24.837 0 16 7.163 0 16 0s16 7.163 16 16z"/>
										<path fill="#fff" d="M9.6 17.92h14.72v-3.84H7.68v3.84H9.6z"/>
									</svg>
									</a>
								</td>
							</tr>
							
							
						</tbody>
					</table>
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
