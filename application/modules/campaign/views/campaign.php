<div class="container">
	<div class="title-top">
		<h1 class="title-icon-on-white">
			<span>Calendrier annuel des campagnes</span>
		</h1>
		<div class="title-top-btns">
			<a href="" class="btn-icon-on-dark on-white">
			<svg class="icon-svg icon-imprimerRouge" width="36" height="32" viewBox="0 0 36 32" x="720">
				<path fill="#e41b13" d="M11.273 18.232H25.09v1.09H11.274v-1.09zm0 4H25.09v1.092H11.274v-1.092zm0 3.998H25.09v1.093H11.274V26.23z"/>
				<path fill="#e41b13" d="M36.364 7.884h-7.637V.25H7.637v7.634H.002v17.453h7.35v6.413H28.73v-6.413h7.637V7.883zM9.09 1.704h18.183v6.18H9.09v-6.18zm18.205 28.593H9.037V14.762h18.258v15.535z"/>
			</svg>
			Imprimer
			</a>
			<a href="" class="btn-icon-on-dark">
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
			</div>
		</div>
	</div>
</div>
<section>
	<div class="container">
		<input type="hidden" id="campain_calendars" value="0">
		<div class="collapsious-wrapper">
			<?php foreach($banners as $key => $banner) : ?>
				<div class="collapsious<?php if ($key == 0) echo ' opened'; ?>">
					<span data-value="<?php echo $key; ?>"><?php echo $banner->campaign_banner_name; ?></span>
					<div class="campaign timeline_<?php echo $key; ?>" id="<?php echo $banner->campaign_banner_name; ?>"></div>
				</div>
			<?php endforeach; ?>
<!--
			<div class="collapsious">
				<span>Metro Affiliés</span>
				<div><p>Your content here</p>
				</div>
			</div>
			<div class="collapsious">
				<span>Super c</span>
				<div><p>Your content here</p>
				</div>
			</div>
			<div class="collapsious">
				<span>Marché richelieu</span>
				<div><p>Your content here</p>
				</div>
			</div>
			<div class="collapsious">
				<span>Brunet</span>
				<div><p>Your content here</p>
				</div>
			</div>
-->
		</div>
	</div>
	
</section>
