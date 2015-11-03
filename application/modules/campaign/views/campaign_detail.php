<div class="container">
	<ul class="breadcrumb">
		<li><a href="">Calendrier annuel de campagnes </a></li>
		<li><span><?php echo $campaign_name; ?> <?php echo $campaign_type; ?></span></li>
	</ul>
	<div class="title-top">
		<h1 class="title-icon-on-white">
			<span><?php echo $campaign_name; ?></span>
		</h1>
		<div class="title-top-btns">
			<a href="" class="btn-icon-on-dark on-white">
			<svg class="icon-svg icon-imprimerRouge" width="36" height="32" viewBox="0 0 36 32" x="720">
				<path fill="#e41b13" d="M11.273 18.232H25.09v1.09H11.274v-1.09zm0 4H25.09v1.092H11.274v-1.092zm0 3.998H25.09v1.093H11.274V26.23z"/>
				<path fill="#e41b13" d="M36.364 7.884h-7.637V.25H7.637v7.634H.002v17.453h7.35v6.413H28.73v-6.413h7.637V7.883zM9.09 1.704h18.183v6.18H9.09v-6.18zm18.205 28.593H9.037V14.762h18.258v15.535z"/>
			</svg>
			Imprimer
			</a>
			<a href="" class="btn-icon-on-dark on-white">
			<svg class="icon-svg icon-documentsRouge" width="33" height="32" viewBox="0 0 33 32" x="288">
				<path fill="#e41b13" d="M14.994.013v1.292h14.354V26.67h2.93V.012H14.995z"/>
				<path fill="#e41b13" d="M6.652 5.317L.115 11.233v20.74h23.372V5.317H6.653zm.94 1.32v5.508H1.508l6.086-5.508z"/>
				<path fill="#e41b13" d="M10.635 2.665v1.292H24.99V29.32h2.855V2.666h-17.21z"/>
			</svg>
			Documents
			</a>
			
			<a href="<?php echo site_url('campaign/edit/'.$campaign_id); ?>" class="btn-icon-on-dark">
			<svg class="icon-svg icon-editerBlanc" width="32" height="32" viewBox="0 0 32 32" x="1440">
				<path fill="#FFF" d="M26.383 11.46v14.39c0 2.208-1.788 3.997-3.997 3.997H6.15c-2.208 0-3.997-1.788-3.997-3.997V9.614c0-2.208 1.788-3.997 3.997-3.997h13.774V3.77H6.15C2.922 3.77.307 6.387.307 9.615V25.85c0 3.228 2.615 5.843 5.843 5.843h16.236c3.228 0 5.843-2.615 5.843-5.843V11.46h-1.85z"/>
				<path fill="#FFF" d="M27.445 0L5.925 21.202v4.665h4.665l21.15-21.52L27.445 0zM6.772 21.627L27.444.85l.9.953-20.3 20.248 2.544 2.55-.424.43H6.772v-3.4z"/>
			</svg>
			Éditer la campagne
			</a>
		</div>
	</div>
	<div class="plan-campagne-wp">
	<h2>plan de campagne</h2>
	<div class="plan-campagne">
		<a class="active" href="">Calendrier</a>
		<a href="">Budget</a>
	</div>
	
	</div>
</div>
<section>
	<div class="container">
		<input type="hidden" id="campaign_calendar" value="0">
		<div id="timeline"></div>
	</div>
</section>
