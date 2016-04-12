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
			<span><?= lang('calendar.title')?></span>
		</h1>
		<div>
		<?php
			if ($this->lang->lang() == 'fr')
			{
				setlocale (LC_TIME, 'fr_CA.utf8','ca'); 
				echo ucfirst(strftime('%A %d %B %Y'));
			}
			else
			{
				setlocale (LC_TIME, 'en_CA.utf8','ca'); 
				echo ucfirst(strftime('%A %d %B %Y'));
			}
			 ?>
		</div>
		<div class="title-top-btns">
			<a style="cursor:pointer;" onclick="frames['frame'].print()" class="btn-icon-on-dark on-white">
			<svg class="icon-svg icon-imprimerRouge" width="36" height="32" viewBox="0 0 36 32" x="720">
				<path fill="#e41b13" d="M11.273 18.232H25.09v1.09H11.274v-1.09zm0 4H25.09v1.092H11.274v-1.092zm0 3.998H25.09v1.093H11.274V26.23z"/>
				<path fill="#e41b13" d="M36.364 7.884h-7.637V.25H7.637v7.634H.002v17.453h7.35v6.413H28.73v-6.413h7.637V7.883zM9.09 1.704h18.183v6.18H9.09v-6.18zm18.205 28.593H9.037V14.762h18.258v15.535z"/>
			</svg>
			<?= lang('calendar.print_btn')?>
			</a>
			<?php
				if ($this->session->userdata('user_permission') <= 2)
				{
			?>
					<a href="<?php echo site_url('campaign/add'); ?>" class="btn-icon-on-dark">
					<svg class="icon-svg icon-ajouterBlanc" viewBox="0 0 32 32" x="1008">
						<path fill="#FFF" d="M16 32c8.837 0 16-7.163 16-16S24.837 0 16 0 0 7.163 0 16s7.163 16 16 16zm0-2.37C8.473 29.63 2.37 23.528 2.37 16S8.472 2.37 16 2.37c7.527 0 13.63 6.102 13.63 13.63S23.528 29.63 16 29.63z"></path>
						<path fill="#FFF" d="M14.84 21.855h2.56v-4.36h4.17V15.03H17.4v-4.363h-2.56v4.36h-4.173v2.466h4.172v4.36z"></path>
					</svg>
					<?= lang('calendar.create_btn')?>
					</a>
			<?php
				}
			?>
		</div>
		<div class="legendes">
			<p class="lendende-text"><?= lang('calendar.legend_lbl')?></p>
			<div class="legende-colors">
				<?php foreach($campaign_types as $campaign_type) : ?>
					<div><span style="background: <?php echo $campaign_type->campaign_type_color; ?>"></span><?php echo $campaign_type->campaign_type_name; ?></div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="legendes">
			<p class="lendende-text"><?= lang('calendar.state_lbl')?></p>
			<div class="legende-colors">
				<?php foreach($campaigns_status as $campaign_status) : ?>
					<div><span style="background: <?php echo $campaign_status->campaign_status_color; ?>"></span><?php echo $campaign_status->campaign_status_name; ?></div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<section>
	<div class="container">
		<input type="hidden" id="campaign_calendars" value="0">
		<div class="collapsious-wrapper">
			<?php foreach($banners as $key => $banner) { ?>
				<div class="collapsious">
					<span data-value="<?php echo $banner->campaign_banner_id; ?>"><?php echo $banner->campaign_banner_name; ?></span>
					<div class="campaign timeline_<?php echo $banner->campaign_banner_id; ?>" id="<?php echo $banner->campaign_banner_name; ?>">
						<label>Date:</label>
						<input class="datechooser" type="text" id="move_to_<?php echo str_replace(' ', '_', $banner->campaign_banner_name); ?>" value="" style="border:solid;1px;width:120px;" />
						<button class="goto" id="goto_<?php echo $banner->campaign_banner_name; ?>" data-id="<?php echo $banner->campaign_banner_name; ?>"><?php echo lang('calendar.goto_btn'); ?></button>
						<?php /*
						<a data-value="<?php echo $banner->campaign_banner_id; ?>" class="unzoom"><img src="<?php echo site_url() ?>assets/images/zoom_minus.png" width="32" height="32" /></a>
						<a data-value="<?php echo $banner->campaign_banner_id; ?>" class="zoom"><img src="<?php echo site_url() ?>assets/images/zoom_plus.png" width="32" height="32" /></a>
						*/ ?>
					</div>
				</div>
			<?php }; ?>
		</div>
	</div>
	<iframe src="<?php echo site_url('campaign/campaign_print/'.$this->session->userdata('current_site_lang')); ?>" name="frame"></iframe>
</section>
