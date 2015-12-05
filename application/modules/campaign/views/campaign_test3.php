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
		<div class="timeline-frame ui-widget ui-widget-content ui-corner-all timeline-selectable" style="height: 353px; width: 100%; cursor: auto;">
			<div style="left: 115px; top: 0px; width: 1005px; height: 340px; overflow:auto;" class="timeline-content">
				<div style="position: absolute; left: 0px; top: 0px; width: 2005px; height: 25px;">
					<div style="position: absolute; left: 0px; width: 100%; border: medium none; top: 0px; height: 25px;" class="timeline-axis"></div>
					<div style="position: absolute; visibility: hidden; padding-left: 0px; padding-right: 0px;" class="timeline-axis-text timeline-axis-text-minor">0</div>
					<div style="position: absolute; visibility: hidden; padding-left: 0px; padding-right: 0px;" class="timeline-axis-text timeline-axis-text-major">0</div>
					<div style="position: absolute; left: -86.0992px; top: 0px;" class="timeline-axis-text timeline-axis-text-minor">Wed 30</div>
					<div style="position: absolute; width: 0px; top: 0px; height: 340px; left: -86.5992px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 26.1657px; top: 0px;" class="timeline-axis-text timeline-axis-text-minor">Thu 1</div>
					<div style="position: absolute; width: 0px; top: 0px; height: 340px; left: 25.6657px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 138.431px; top: 0px;" class="timeline-axis-text timeline-axis-text-minor">Fri 2</div>
					<div style="position: absolute; width: 0px; top: 0px; height: 340px; left: 137.931px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 250.696px; top: 0px;" class="timeline-axis-text timeline-axis-text-minor">Sat 3</div>
					<div style="position: absolute; width: 0px; top: 0px; height: 340px; left: 250.196px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 362.96px; top: 0px;" class="timeline-axis-text timeline-axis-text-minor">Sun 4</div>
					<div style="position: absolute; width: 0px; top: 0px; height: 340px; left: 362.46px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 475.225px; top: 0px;" class="timeline-axis-text timeline-axis-text-minor">Mon 5</div>
					<div style="position: absolute; width: 0px; top: 0px; height: 340px; left: 474.725px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 587.49px; top: 0px;" class="timeline-axis-text timeline-axis-text-minor">Tue 6</div>
					<div style="position: absolute; width: 0px; top: 0px; height: 340px; left: 586.99px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 699.755px; top: 0px;" class="timeline-axis-text timeline-axis-text-minor">Wed 7</div>
					<div style="position: absolute; width: 0px; top: 0px; height: 340px; left: 699.255px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 812.02px; top: 0px;" class="timeline-axis-text timeline-axis-text-minor">Thu 8</div>
					<div style="position: absolute; width: 0px; top: 0px; height: 340px; left: 811.52px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 924.285px; top: 0px;" class="timeline-axis-text timeline-axis-text-minor">Fri 9</div>
					<div style="position: absolute; width: 0px; top: 0px; height: 340px; left: 923.785px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 1036.55px; top: 0px;" class="timeline-axis-text timeline-axis-text-minor">Sat 10</div>
					<div style="position: absolute; width: 0px; top: 0px; height: 340px; left: 1036.055px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
					<div style="position: absolute; left: 0px; width: 100%; height: 0px; top: 25px;" class="timeline-axis"></div>
				</div>
				<div style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 321px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 289px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 257px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 225px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 193px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 164px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 135px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 106px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 77px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; left: 0px; top: 0px; height: 100%; width: 0px;">
					<div title="Current time: Fri Dec 04 2015 15:56:07 GMT-0500 (EST)" style="position: absolute; top: 0px; height: 100%; left: 7290.34px; display: none;" class="timeline-currenttime"></div>
				</div>
				<div style="position: relative; left: 0px; top: 0px; height: 0px;">
					<div style="position: absolute; display: none;" class="timeline-navigation-delete"></div>
					<div style="position: absolute; display: none;" class="timeline-event-range-drag-left"></div>
					<div style="position: absolute; display: none;" class="timeline-event-range-drag-right"></div>
					<div class="timeline-event timeline-event-range ui-widget ui-state-default encarts-reguliers" style="position: absolute; top: 50px; left: -1005px; width: 1031.17px;">
						<div class="timeline-event-content"><a style="color:#ffffff;font-weight:bold;" id="a_1" class="popups" data-content="Amqui">12/01/2015</a></div>
					</div>
					<div class="timeline-event timeline-event-range ui-widget ui-state-default relocalisation" style="position: absolute; top: 186px; left: -1005px; width: 3015px;">
						<div class="timeline-event-content"><a style="color:#ffffff;font-weight:bold;" id="a_7" class="popups" data-content="Cité des jeunes">12/01/2015</a></div>
					</div>
					<div class="timeline-event timeline-event-range ui-widget ui-state-default reno-majeurs" style="position: absolute; top: 218px; left: -1005px; width: 3015px;">
						<div class="timeline-event-content"><a style="color:#ffffff;font-weight:bold;" id="a_8" class="popups" data-content="Griffintown">12/01/2015</a></div>
					</div>
					<div class="timeline-event timeline-event-range ui-widget ui-state-default reno-majeurs" style="position: absolute; top: 154px; left: -647.424px; width: 2245.3px;">
						<div class="timeline-event-content"><a style="color:#ffffff;font-weight:bold;" id="a_6" class="popups" data-content="Neufchàtel">12/01/2015</a></div>
					</div>
					<div class="timeline-event timeline-event-range ui-widget ui-state-default ouverture" style="position: absolute; top: 122px; left: 138.431px; width: 1871.57px;">
						<div class="timeline-event-content"><a style="color:#ffffff;font-weight:bold;" id="a_5" class="popups" data-content="Arthur-Sauvé">12/01/2015</a></div>
					</div>
				</div>
			</div>
			<div style="position: absolute; overflow: hidden; top: 0px; height: 100%; left: 0px; width: 115px;" class="timeline-groups-axis timeline-groups-axis-onleft">
				<div style="position: absolute; left: 0px; width: 100%; border: medium none; top: 0px; height: 25px;" class="timeline-axis"></div>
				<div style="position: absolute; left: 0px; width: 100%; height: 0px; top: 25px;" class="timeline-axis"></div>
				<div style="position: absolute; white-space: nowrap; top: 51.5px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/1">Amqui</a></div>
				<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 77px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; white-space: nowrap; top: 82px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/18">Sherbrooke</a></div>
				<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 106px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; white-space: nowrap; top: 111px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/2">St-Nicolas</a></div>
				<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 135px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; white-space: nowrap; top: 140px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/3">Dorion</a></div>
				<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 164px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; white-space: nowrap; top: 169px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/4">Rimouski</a></div>
				<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 193px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; white-space: nowrap; top: 199.5px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/5">Arthur-Sauvé</a></div>
				<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 225px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; white-space: nowrap; top: 231.5px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/6">Neufchàtel</a></div>
				<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 257px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; white-space: nowrap; top: 263.5px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/7">Cité des jeunes</a></div>
				<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 289px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
				<div style="position: absolute; white-space: nowrap; top: 295.5px;" class="timeline-groups-text"><a href="http://metro.toolbox/en/campaign/edit/8">Griffintown</a></div>
				<div style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 321px;" class="timeline-axis-grid timeline-axis-grid-minor"></div>
			</div>
		</div>
	</div>
	<input type="hidden" value="<?php /*echo $openedid*/; ?>" id="openedid">
</section>
