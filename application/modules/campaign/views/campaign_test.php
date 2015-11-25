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
<div class="container">
	<div class="title-top">
		<h1 class="title-icon-on-white">
			<span>Calendrier annuel des campagnes</span>
		</h1>
		<div><?php
					setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
					echo strftime('%A %d %B %Y');
			 ?></div>
		<div class="title-top-btns">
			<a href="" class="btn-icon-on-dark on-white">
			<svg class="icon-svg icon-imprimerRouge" width="36" height="32" viewBox="0 0 36 32" x="720">
				<path fill="#e41b13" d="M11.273 18.232H25.09v1.09H11.274v-1.09zm0 4H25.09v1.092H11.274v-1.092zm0 3.998H25.09v1.093H11.274V26.23z"/>
				<path fill="#e41b13" d="M36.364 7.884h-7.637V.25H7.637v7.634H.002v17.453h7.35v6.413H28.73v-6.413h7.637V7.883zM9.09 1.704h18.183v6.18H9.09v-6.18zm18.205 28.593H9.037V14.762h18.258v15.535z"/>
			</svg>
			Imprimer
			</a>
			<a href="<?php echo site_url('campaign/add'); ?>" class="btn-icon-on-dark">
			<svg class="icon-svg icon-ajouterBlanc" viewBox="0 0 32 32" x="1008">
				<path fill="#FFF" d="M16 32c8.837 0 16-7.163 16-16S24.837 0 16 0 0 7.163 0 16s7.163 16 16 16zm0-2.37C8.473 29.63 2.37 23.528 2.37 16S8.472 2.37 16 2.37c7.527 0 13.63 6.102 13.63 13.63S23.528 29.63 16 29.63z"></path>
				<path fill="#FFF" d="M14.84 21.855h2.56v-4.36h4.17V15.03H17.4v-4.363h-2.56v4.36h-4.173v2.466h4.172v4.36z"></path>
			</svg>
			Créer une campagne
			</a>
		</div>
		<div class="legendes">
			<p class="lendende-text">Légende</p>
			<div class="legende-colors">
				<div class="legende-blue"><span></span>Encarts réguliers</div>
				<div class="legende-green"><span></span>Ouverture</div>
				<div class="legende-violet"><span></span>Relocalisation</div>
				<div class="legende-orange"><span></span>Réno. Transformations</div>
				<div class="legende-red"><span></span>Réno. Majeures</div>
				<div class="legende-yellow"><span></span>Réno. Mineures</div>
				<div class="legende-grey"><span></span>N/A</div>
			</div>
		</div>
	</div>
</div>
<section>
	<div class="container">
		<input type="hidden" id="campaign_calendars" value="0">
		<div class="collapsious-wrapper">
			<div style="height: 378px; width: 100%;" class="timeline-frame ui-widget ui-widget-content ui-corner-all timeline-selectable">
				<div style="left: 120px; top: 0px; width: 1000px; height: 377px;" class="timeline-content">
					<div style="position: absolute; left: 0px; top: 0px; width: 1000px; height: 50px;">
						<div style="position: absolute; left: 0px; width: 100%; border: medium none; top: 0px; height: 50px;" class="timeline-axis"></div>
						<div style="position: absolute; visibility: hidden; padding-left: 0px; padding-right: 0px;" class="timeline-axis-text timeline-axis-text-minor">0</div>
						<div style="position: absolute; visibility: hidden; padding-left: 0px; padding-right: 0px;" class="timeline-axis-text timeline-axis-text-major">0</div>
						<div style="position: absolute; left: -13.5002px; top: 25px;" class="timeline-axis-text timeline-axis-text-minor">Jun</div>
						<div style="position: absolute; width: 0px; top: 25px; height: 352px; left: -14.0002px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
						<div style="position: absolute; top: 0px; left: 0px;" class="timeline-axis-text timeline-axis-text-major">2015</div>
						<div style="position: absolute; left: 133.887px; top: 25px;" class="timeline-axis-text timeline-axis-text-minor">Jul</div>
						<div style="position: absolute; width: 0px; top: 25px; height: 352px; left: 133.387px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
						<div style="position: absolute; left: 286.187px; top: 25px;" class="timeline-axis-text timeline-axis-text-minor">Aug</div>
						<div style="position: absolute; width: 0px; top: 25px; height: 352px; left: 285.687px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
						<div style="position: absolute; left: 438.486px; top: 25px;" class="timeline-axis-text timeline-axis-text-minor">Sep</div>
						<div style="position: absolute; width: 0px; top: 25px; height: 352px; left: 437.986px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
						<div style="position: absolute; left: 585.873px; top: 25px;" class="timeline-axis-text timeline-axis-text-minor">Oct</div>
						<div style="position: absolute; width: 0px; top: 25px; height: 352px; left: 585.373px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
						<div style="position: absolute; left: 738.173px; top: 25px;" class="timeline-axis-text timeline-axis-text-minor">Nov</div>
						<div style="position: absolute; width: 0px; top: 25px; height: 352px; left: 737.673px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
						<div style="position: absolute; left: 885.765px; top: 25px;" class="timeline-axis-text timeline-axis-text-minor">Dec</div>
						<div style="position: absolute; width: 0px; top: 25px; height: 352px; left: 885.265px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
						<div style="position: absolute; left: 0px; width: 100%; height: 0px; top: 50px;" class="timeline-axis"></div>
					</div>
					<div style="position: absolute; left: 0px; width: 1000px; height: 0px; border-top-style: solid; top: 358px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 0px; width: 1000px; height: 0px; border-top-style: solid; top: 326px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 0px; width: 1000px; height: 0px; border-top-style: solid; top: 294px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 0px; width: 1000px; height: 0px; border-top-style: solid; top: 262px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 0px; width: 1000px; height: 0px; border-top-style: solid; top: 230px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 0px; width: 1000px; height: 0px; border-top-style: solid; top: 198px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 0px; width: 1000px; height: 0px; border-top-style: solid; top: 166px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 0px; width: 1000px; height: 0px; border-top-style: solid; top: 134px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 0px; width: 1000px; height: 0px; border-top-style: solid; top: 102px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 0px; top: 0px; height: 100%; width: 0px;">
						<div title="Current time: Tue Nov 24 2015 14:10:25 GMT-0500 (EST)" style="position: absolute; top: 0px; height: 100%; left: 854.276px;" class="timeline-currenttime"></div>
					</div>
					<div style="position: relative; left: 0px; top: 0px; height: 0px;">
						<div style="position: absolute; display: none;" class="timeline-navigation-delete"></div>
						<div style="position: absolute; display: none;" class="timeline-event-range-drag-left"></div>
						<div style="position: absolute; display: none;" class="timeline-event-range-drag-right"></div>
						<div class="timeline-event timeline-event-range ui-widget ui-state-default reno-majeurs" style="position: absolute; top: 139px; left: 802.246px; width: 152.3px;">
							<div class="timeline-event-content"><a style="color:#ffffff;font-weight:bold;" id="a_2" class="popups" data-content="St-Nicolas">12/01/2015</a></div>
						</div>
						<div class="timeline-event timeline-event-range ui-widget ui-state-default ouverture" style="position: absolute; top: 235px; left: 590.786px; width: 216.372px;">
							<div class="timeline-event-content"><a style="color:#ffffff;font-weight:bold;" id="a_5" class="popups" data-content="Arthur-Sauvé">12/01/2015</a></div>
						</div>
						<div class="timeline-event timeline-event-range ui-widget ui-state-default relocalisation" style="position: absolute; top: 299px; left: 428.661px; width: 378.498px;">
							<div class="timeline-event-content"><a style="color:#ffffff;font-weight:bold;" id="a_7" class="popups" data-content="Cité des jeunes">12/01/2015</a></div>
						</div>
						<div class="timeline-event timeline-event-range ui-widget ui-state-default reno-majeurs" style="position: absolute; top: 331px; left: 482.703px; width: 471.843px;">
							<div class="timeline-event-content"><a style="color:#ffffff;font-weight:bold;" id="a_8" class="popups" data-content="Griffintown">12/01/2015</a></div>
						</div>
						<div class="timeline-event timeline-event-range ui-widget ui-state-default encarts-reguliers" style="position: absolute; top: 75px; left: 433.574px; width: 152.3px;">
							<div class="timeline-event-content"><a style="color:#ffffff;font-weight:bold;" id="a_1" class="popups" data-content="Amqui.">12/01/2015</a></div>
						</div>
						<div class="timeline-event timeline-event-range ui-widget ui-state-default reno-transformations" style="position: absolute; top: 171px; left: 45.4545px; width: 157.213px;">
							<div class="timeline-event-content"><a style="color:#ffffff;font-weight:bold;" id="a_3" class="popups" data-content="Dorion">12/01/2015</a></div>
						</div>
						<div class="timeline-event timeline-event-range ui-widget ui-state-default default" style="position: absolute; top: 203px; left: 153.538px; width: 201.429px;">
							<div class="timeline-event-content"><a style="color:#ffffff;font-weight:bold;" id="a_4" class="popups" data-content="Rimouski">12/01/2015</a></div>
						</div>
						<div class="timeline-event timeline-event-range ui-widget ui-state-default reno-majeurs" style="position: absolute; top: 267px; left: 556.396px; width: 98.258px;">
							<div class="timeline-event-content"><a style="color:#ffffff;font-weight:bold;" id="a_6" class="popups" data-content="Neufchàtel">12/01/2015</a></div>
						</div>
						<div class="timeline-event timeline-event-range ui-widget ui-state-default ouverture" style="position: absolute; top: 107px; left: 812.071px; width: 1px;">
							<div class="timeline-event-content"><a style="color:#ffffff;font-weight:bold;" id="a_18" class="popups" data-content="Sherbrooke">02/28/2019</a></div>
						</div>
					</div>
				</div>
				<div style="position: absolute; overflow: hidden; top: 0px; height: 100%; left: 0px; width: 120px;" class="timeline-groups-axis timeline-groups-axis-onleft">
					<div style="position: absolute; left: 0px; width: 100%; border: medium none; top: 0px; height: 50px;" class="timeline-axis"></div>
					<div style="position: absolute; left: 0px; width: 100%; height: 0px; top: 50px;" class="timeline-axis"></div>
					<div style="position: absolute; white-space: nowrap; top: 76.5px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/1">Amqui.</a></div>
					<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 102px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; white-space: nowrap; top: 108.5px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/18">Sherbrooke</a></div>
					<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 134px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; white-space: nowrap; top: 140.5px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/2">St-Nicolas</a></div>
					<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 166px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; white-space: nowrap; top: 172.5px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/3">Dorion</a></div>
					<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 198px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; white-space: nowrap; top: 204.5px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/4">Rimouski</a></div>
					<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 230px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; white-space: nowrap; top: 236.5px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/5">Arthur-Sauvé</a></div>
					<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 262px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; white-space: nowrap; top: 268.5px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/6">Neufchàtel</a></div>
					<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 294px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; white-space: nowrap; top: 300.5px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/7">Cité des jeunes</a></div>
					<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 326px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; white-space: nowrap; top: 332.5px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/8">Griffintown</a></div>
					<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 358px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" value="<?php /*echo $openedid*/; ?>" id="openedid">
</section>
