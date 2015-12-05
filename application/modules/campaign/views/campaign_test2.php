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
			<div class="timeline-content" style="left: 115px; top: 0px; width: 1005px; height: 352px;">
				<div style="position: absolute; left: 0px; top: 0px; width: 1005px; height: 25px;">
					<div class="timeline-axis" style="position: absolute; left: 0px; width: 100%; border: medium none; top: 0px; height: 25px;"></div>
					<div class="timeline-axis-text timeline-axis-text-minor" style="position: absolute; visibility: hidden; padding-left: 0px; padding-right: 0px;">0</div>
					<div class="timeline-axis-text timeline-axis-text-major" style="position: absolute; visibility: hidden; padding-left: 0px; padding-right: 0px;">0</div>
					<div class="timeline-axis-text timeline-axis-text-minor" style="position: absolute; left: -50.333px; top: 0px;">2012</div>
					<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; width: 0px; top: 0px; height: 352px; left: -50.833px;"></div>
					<div class="timeline-axis-text timeline-axis-text-minor" style="position: absolute; left: 143.704px; top: 0px;">2013</div>
					<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; width: 0px; top: 0px; height: 352px; left: 143.204px;"></div>
					<div class="timeline-axis-text timeline-axis-text-minor" style="position: absolute; left: 337.211px; top: 0px;">2014</div>
					<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; width: 0px; top: 0px; height: 352px; left: 336.711px;"></div>
					<div class="timeline-axis-text timeline-axis-text-minor" style="position: absolute; left: 530.718px; top: 0px;">2015</div>
					<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; width: 0px; top: 0px; height: 352px; left: 530.218px;"></div>
					<div class="timeline-axis-text timeline-axis-text-minor" style="position: absolute; left: 724.225px; top: 0px;">2016</div>
					<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; width: 0px; top: 0px; height: 352px; left: 723.725px;"></div>
					<div class="timeline-axis-text timeline-axis-text-minor" style="position: absolute; left: 918.262px; top: 0px;">2017</div>
					<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; width: 0px; top: 0px; height: 352px; left: 917.762px;"></div>
					<div class="timeline-axis" style="position: absolute; left: 0px; width: 100%; height: 0px; top: 25px;"></div>
				</div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 333px;"></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 301px;"></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 269px;"></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 237px;"></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 205px;"></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 173px;"></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 141px;"></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 109px;"></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 1005px; height: 0px; border-top-style: solid; top: 77px;"></div>
				<div style="position: absolute; left: 0px; top: 0px; height: 100%; width: 0px;">
					<div class="timeline-currenttime" style="position: absolute; top: 0px; height: 100%; left: 709.708px;" title="Current time: Fri Dec 04 2015 14:50:36 GMT-0500 (EST)"></div>
				</div>
				<div style="position: relative; left: 0px; top: 0px; height: 0px;">
					<div class="timeline-navigation-delete" style="position: absolute; display: none;"></div>
					<div class="timeline-event-range-drag-left" style="position: absolute; display: none;"></div>
					<div class="timeline-event-range-drag-right" style="position: absolute; display: none;"></div>
					<div style="position: absolute; top: 114px; left: 698.778px; width: 16.4348px;" class="timeline-event timeline-event-range ui-widget ui-state-default reno-majeurs">
						<div class="timeline-event-content"><a data-content="St-Nicolas" class="popups" id="a_2" style="color:#ffffff;font-weight:bold;">12/01/2015</a></div>
					</div>
					<div style="position: absolute; top: 306px; left: 664.295px; width: 50.9171px;" class="timeline-event timeline-event-range ui-widget ui-state-default reno-majeurs">
						<div class="timeline-event-content"><a data-content="Griffintown" class="popups" id="a_8" style="color:#ffffff;font-weight:bold;">12/01/2015</a></div>
					</div>
					<div style="position: absolute; top: 50px; left: 658.994px; width: 16.4348px;" class="timeline-event timeline-event-range ui-widget ui-state-default encarts-reguliers">
						<div class="timeline-event-content"><a data-content="Amqui" class="popups" id="a_1" style="color:#ffffff;font-weight:bold;">12/01/2015</a></div>
					</div>
					<div style="position: absolute; top: 146px; left: 617.111px; width: 16.965px;" class="timeline-event timeline-event-range ui-widget ui-state-default reno-transformations">
						<div class="timeline-event-content"><a data-content="Dorion" class="popups" id="a_3" style="color:#ffffff;font-weight:bold;">12/01/2015</a></div>
					</div>
					<div style="position: absolute; top: 178px; left: 628.775px; width: 21.7364px;" class="timeline-event timeline-event-range ui-widget ui-state-default default">
						<div class="timeline-event-content"><a data-content="Rimouski" class="popups" id="a_4" style="color:#ffffff;font-weight:bold;">12/01/2015</a></div>
					</div>
					<div style="position: absolute; top: 210px; left: 675.959px; width: 23.349px;" class="timeline-event timeline-event-range ui-widget ui-state-default ouverture">
						<div class="timeline-event-content"><a data-content="Arthur-Sauvé" class="popups" id="a_5" style="color:#ffffff;font-weight:bold;">12/01/2015</a></div>
					</div>
					<div style="position: absolute; top: 242px; left: 672.248px; width: 10.6031px;" class="timeline-event timeline-event-range ui-widget ui-state-default reno-majeurs">
						<div class="timeline-event-content"><a data-content="Neufchàtel" class="popups" id="a_6" style="color:#ffffff;font-weight:bold;">12/01/2015</a></div>
					</div>
					<div style="position: absolute; top: 274px; left: 658.464px; width: 40.8441px;" class="timeline-event timeline-event-range ui-widget ui-state-default relocalisation">
						<div class="timeline-event-content"><a data-content="Cité des jeunes" class="popups" id="a_7" style="color:#ffffff;font-weight:bold;">12/01/2015</a></div>
					</div>
					<div style="position: absolute; top: 82px; left: 699.838px; width: 1px;" class="timeline-event timeline-event-range ui-widget ui-state-default ouverture">
						<div class="timeline-event-content"><a data-content="Sherbrooke" class="popups" id="a_18" style="color:#ffffff;font-weight:bold;">02/28/2019</a></div>
					</div>
				</div>
			</div>
			<div class="timeline-groups-axis timeline-groups-axis-onleft" style="position: absolute; overflow: hidden; top: 0px; height: 100%; left: 0px; width: 115px;">
				<div class="timeline-axis" style="position: absolute; left: 0px; width: 100%; border: medium none; top: 0px; height: 25px;"></div>
				<div class="timeline-axis" style="position: absolute; left: 0px; width: 100%; height: 0px; top: 25px;"></div>
				<div class="timeline-groups-text" style="position: absolute; white-space: nowrap; top: 51.5px;"><a href="http://metro.toolbox/en/campaign/edit/1">Amqui</a></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 77px;"></div>
				<div class="timeline-groups-text" style="position: absolute; white-space: nowrap; top: 83.5px;"><a href="http://metro.toolbox/en/campaign/edit/18">Sherbrooke</a></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 109px;"></div>
				<div class="timeline-groups-text" style="position: absolute; white-space: nowrap; top: 115.5px;"><a href="http://metro.toolbox/en/campaign/edit/2">St-Nicolas</a></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 141px;"></div>
				<div class="timeline-groups-text" style="position: absolute; white-space: nowrap; top: 147.5px;"><a href="http://metro.toolbox/en/campaign/edit/3">Dorion</a></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 173px;"></div>
				<div class="timeline-groups-text" style="position: absolute; white-space: nowrap; top: 179.5px;"><a href="http://metro.toolbox/en/campaign/edit/4">Rimouski</a></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 205px;"></div>
				<div class="timeline-groups-text" style="position: absolute; white-space: nowrap; top: 211.5px;"><a href="http://metro.toolbox/en/campaign/edit/5">Arthur-Sauvé</a></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 237px;"></div>
				<div class="timeline-groups-text" style="position: absolute; white-space: nowrap; top: 243.5px;"><a href="http://metro.toolbox/en/campaign/edit/6">Neufchàtel</a></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 269px;"></div>
				<div class="timeline-groups-text" style="position: absolute; white-space: nowrap; top: 275.5px;"><a href="http://metro.toolbox/en/campaign/edit/7">Cité des jeunes</a></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 301px;"></div>
				<div class="timeline-groups-text" style="position: absolute; white-space: nowrap; top: 307.5px;"><a href="http://metro.toolbox/en/campaign/edit/8">Griffintown</a></div>
				<div class="timeline-axis-grid timeline-axis-grid-minor" style="position: absolute; left: 0px; width: 100%; height: 0px; border-top-style: solid; top: 333px;"></div>
			</div>
		</div>
	</div>
	<input type="hidden" value="<?php /*echo $openedid*/; ?>" id="openedid">
</section>
