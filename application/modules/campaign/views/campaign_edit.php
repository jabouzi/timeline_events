<div class="container">
	<ul class="breadcrumb">
		<li><a href="<?php echo site_url('campaign'); ?>"><?= lang('calendar.title')?></a></li>
		<li><a href="<?php echo site_url('campaign/edit/'.$campaign->campaign_id); ?>"><?php echo $campaign->campaign_title; ?> <?php echo $campaign_type; ?></a></li>
		<li><span><?= lang('campaign.edit_title')?></span></li>
	</ul>
	<div class="title-top">
		<h1 class="title-icon-on-white">
			
			<svg class="icon-svg icon-editionRouge"  viewBox="0 0 46 32" x="480">
				<path fill="#e41b13" d="M12.04 3.504l-.09 2.924c-.95.203-1.874.526-2.746.962L7.31 5.16c-.716.404-1.4.868-2.04 1.39l1.386 2.577c-.713.64-1.354 1.38-1.9 2.21l-2.754-.983c-.208.354-.405.714-.585 1.088-.18.375-.34.754-.486 1.136.74.454 1.59.98 2.49 1.54-.3.942-.48 1.903-.54 2.86L0 17.505c-.01.828.054 1.65.187 2.462l2.924.087c.21.953.53 1.877.97 2.747l-2.23 1.9c.41.72.87 1.4 1.4 2.05l2.57-1.39c.65.72 1.39 1.35 2.21 1.9L7.04 30c.35.206.71.403 1.086.582.376.182.756.342 1.14.486l1.538-2.487c.94.31 1.9.49 2.857.55l.53 2.87c.83.01 1.66-.05 2.47-.18l.09-2.92c.95-.2 1.88-.52 2.75-.96l1.9 2.23c.72-.4 1.4-.86 2.05-1.38l-1.4-2.59c.71-.64 1.35-1.38 1.89-2.21l2.75.99c.21-.35.41-.71.59-1.09.18-.37.34-.75.48-1.13l-2.49-1.54c.31-.94.49-1.9.54-2.86l2.88-.52c.01-.82-.05-1.65-.19-2.46l-2.92-.08c-.2-.95-.53-1.87-.96-2.74l2.23-1.89c-.4-.72-.87-1.4-1.39-2.04L22.88 10c-.64-.71-1.38-1.35-2.21-1.897l.983-2.753c-.35-.21-.71-.407-1.09-.587-.37-.18-.75-.34-1.13-.487l-1.53 2.49c-.943-.31-1.903-.487-2.86-.544l-.52-2.88h-.16c-.777 0-1.547.06-2.304.19zm-.212 19.382c-2.888-1.388-4.105-4.854-2.714-7.743 1.39-2.89 4.856-4.105 7.743-2.715 2.89 1.39 4.105 4.856 2.715 7.744-1 2.077-3.072 3.29-5.232 3.29-.844 0-1.7-.185-2.512-.576z"/>
				<path fill="#e41b13" d="M31.5 1.094l.657 3.02c-.672.42-1.28.957-1.79 1.597-1.032-.34-2.046-.68-2.93-.98-.21.33-.408.68-.58 1.04-.174.36-.32.72-.446 1.09.79.51 1.69 1.09 2.6 1.67-.18.8-.22 1.61-.13 2.41l-2.77 1.38c.17.77.43 1.52.78 2.23l3.02-.65c.42.68.96 1.29 1.61 1.8l-.98 2.93c.33.21.67.41 1.04.58.36.18.73.32 1.1.45.51-.78 1.09-1.69 1.68-2.6.8.19 1.62.23 2.41.13l1.37 2.77c.77-.17 1.52-.43 2.23-.78-.2-.91-.42-1.96-.65-3.02.67-.42 1.28-.96 1.79-1.6l2.93.99c.21-.32.4-.67.57-1.02.18-.36.33-.73.45-1.1l-2.6-1.67c.18-.8.23-1.61.13-2.4l2.77-1.373c-.17-.77-.43-1.52-.78-2.23l-3.02.658c-.42-.67-.953-1.28-1.592-1.79l.99-2.93c-.33-.21-.67-.41-1.03-.58-.36-.174-.727-.32-1.097-.45l-1.7 2.58c-.8-.182-1.606-.224-2.39-.133L33.73.314c-.77.17-1.52.433-2.23.78zm2.984 11.995c-1.64-.79-2.33-2.76-1.54-4.4.787-1.64 2.756-2.33 4.396-1.54 1.64.78 2.33 2.75 1.54 4.39-.567 1.18-1.745 1.87-2.97 1.87-.48 0-.966-.11-1.426-.33z"/>
			</svg>
			<span><?php echo $campaign->campaign_title; ?> <?php echo $campaign_type; ?></span>
		</h1>
		<div class="title-top-btns">
			<a href="<?php echo site_url('campaign'); ?>" class="btn-icon-on-dark on-white">
			<?= lang('campaign.return_btn')?>
			</a>
			<a style="cursor:pointer;" class="submit_form btn-icon-on-dark submit" data-value="campaign_edit">
			<svg class="icon-svg icon-sauvegarderBlanc" viewBox="0 0 31 32" x="1920">
				<path fill="#FFF" d="M22.652.35v8.792H6.1V.352H0V32h30.493V5.95l-4.68-5.6h-3.16zM4.356 13.54h20.91v13.187H4.356v-13.19z"/>
				<path fill="#FFF" d="M8.712 6.505h11.326V.35H8.712v6.155z"/>
			</svg>
			<?= lang('form.save_btn')?>
			</a>
		</div>
	</div>
</div>
<section>	
	<div class="container">
		<form id="campaign_edit" method="post" action="<?php echo site_url('campaign/process_edit_campaign'); ?>">
		<input type="hidden" name="campaign_id" value="<?php echo $campaign->campaign_id; ?>">
		<div class="row">
			<div class="col-sm-6">
				<h2 class="icon-label">
					<svg class="icon-svg icon-identificationRouge" width="50" height="32" viewBox="0 0 50 32" x="624">
						<path fill="#e41b13" d="M0 0l.113 5.814H30.64L30.617 0H0zm.15 18.945l49.358.03V13.06L.15 12.965v5.98zM.15 32h21.756v-5.93H.15V32z"/>
					</svg>
					<span><?= lang('form.id_title')?></span>
				</h2>
				<div class="grayBox">
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<label for="campaign_banner_id" id="label_campaign_banner_id"><?= lang('form.banner_lbl')?></label>
							<div class="wrapper-select-top">
								<?php echo form_dropdown('campaign_banner_id', $campaign_banners, @$campaign->campaign_banner_id, 'data-validate="required" data-type="option" id="campaign_banner_id"'); ?>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<label for="campaign_type_id" id="label_campaign_type_id"><?= lang('form.campaign_type_lbl')?></label>
							<div class="wrapper-select-top">
								<?php echo form_dropdown('campaign_type_id', $campaign_types, @$campaign->campaign_type_id); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<label for="campaign_title" id="label_campaign_title"><?= lang('form.campaign_title_lbl')?></label>
							<input  type="text" name="campaign_title" id="campaign_title" value="<?php echo $campaign->campaign_title; ?>"  maxlength="20" data-validate="required" data-type="text"/>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<label for="campaign_city" id="label_campaign_city"><?= lang('form.campaign_tity_lbl')?></label>
							<input  type="text" name="campaign_city" id="campaign_city" value="<?php echo $campaign->campaign_city; ?>"  data-validate="required" data-type="text"/>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label for="campaign_date_start" id="label_campaign_date_start"><?= lang('form.start_date_lbl')?></label>
							<input class="datechooser" type="text" name="campaign_date_start" id="campaign_date_start" value="<?php if (isset($campaign->campaign_date_start) && $campaign->campaign_date_start != '0000-00-00' ) { echo date('d/m/Y', strtotime($campaign->campaign_date_start)); } ?>" data-type="text"/>
						</div>
						<div class="col-sm-6">
							<label for="campaign_date_evenement" id="label_campaign_date_evenement"><?= lang('form.event_date_lbl')?></label>
							<input class="datechooser" type="text" name="campaign_date_evenement" id="campaign_date_evenement" value="<?php if (isset($campaign->campaign_date_evenement) && $campaign->campaign_date_evenement != '0000-00-00' ) { echo date('d/m/Y', strtotime($campaign->campaign_date_evenement)); } ?>" data-type="text"/>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<label for="campaign_branch"id="label_campaign_branch"><?= lang('form.shop_name_lbl')?></label>
							<input type="text" name="campaign_branch" id="campaign_branch" value="<?php echo $campaign->campaign_branch; ?>" data-type="text"/>
						</div>
						<div class="col-sm-12 col-md-6">
							<label for="campaign_address" id="label_campaign_address"><?= lang('form.shop_address_lbl')?></label>
							<input type="text" name="campaign_address" id="campaign_address" value="<?php echo $campaign->campaign_address; ?>" data-type="text"/>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<label for="campaign_manager_tgi" id="label_campaign_manager_tgi"><?= lang('form.shop_pm_lbl')?></label>
							<div class="wrapper-select-top">
								<?php echo form_dropdown('campaign_manager_tgi', $campaign_managers_tgi, $campaign->campaign_manager_tgi, 'id="campaign_manager_tgi"'); ?>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<label for="campaign_manager_client" id="label_campaign_manager_client"><?= lang('form.shop_coordonator_lbl')?></label>
							<div class="wrapper-select-top">
								<?php echo form_dropdown('campaign_manager_client', $campaign_managers_client, $campaign->campaign_manager_client, 'id="campaign_manager_client"'); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<label for="campaign_project_number" id="label_campaign_project_number"><?= lang('form.shop_projectno_lbl')?></label>
							<input type="text" name="campaign_project_number" id="campaign_project_number" value="<?php echo $campaign->campaign_project_number; ?>" data-type="text"/>
						</div>
						<div class="col-sm-12 col-md-6">
							<label for="campaign_store_number" id="label_campaign_store_number"><?= lang('form.shop_shopno_lbl')?></label>
							<input type="text" name="campaign_store_number" id="campaign_store_number" value="<?php echo $campaign->campaign_store_number; ?>" data-type="text"/>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<label for="campaign_budget" id="label_campaign_budget"><?php echo lang('campaign.budget'); ?></label>
							<input type="text" name="campaign_budget" id="campaign_budget" value="<?php echo $campaign->campaign_budget; ?>" data-type="text"/>
						</div>
						<div class="col-sm-12 col-md-6">
							<label for="campaign_status" id="label_campaign_status"><?php echo lang('campaign.status'); ?></label>
							<div class="wrapper-select-top">
								<?php echo form_dropdown('campaign_status', $campaign_status, $campaign->campaign_status, 'id="campaign_status"'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<h2 class="icon-label">
					
					<svg class="icon-svg icon-etapesRouge" viewBox="0 0 29 32" x="576">
						<path fill="#e41b13" d="M0 10.24v19.17C0 30.84 1.148 32 2.564 32H25.64c1.416 0 2.564-1.16 2.564-2.59V10.24H0zm21.153 1.92h5.128v5.12h-5.12v-5.12zm-6.41 0h5.128v5.12h-5.12v-5.12zm-6.41 0h5.128v5.12H8.34v-5.12zm-6.41 0H7.05v5.12H1.924v-5.12zm19.23 6.4h5.128v5.12h-5.12v-5.12zm-6.41 0h5.128v5.12h-5.12v-5.12zm-6.41 0h5.128v5.12H8.34v-5.12zm-6.41 0H7.05v5.12H1.924v-5.12zm19.23 6.4h5.128v5.12h-5.12v-5.12zm-6.41 0h5.128v5.12h-5.12v-5.12zm-6.41 0h5.128v5.12H8.34v-5.12zm-6.41 0H7.05v5.12H1.924v-5.12zM19.55.96v2.88H8.653V.96c0-.53-.43-.96-.96-.96-.532 0-.962.43-.962.96v2.88H2.57C1.15 3.84 0 5 0 6.43v2.53h28.204V6.43c0-1.43-1.148-2.59-2.564-2.59h-4.166V.96c0-.53-.43-.96-.96-.96-.532 0-.962.43-.962.96zm1.923 5.44V4.74c.574.33.96.95.96 1.66 0 1.06-.86 1.92-1.922 1.92-1.06 0-1.92-.86-1.92-1.92 0-.71.39-1.33.96-1.66V6.4c0 .53.43.96.96.96s.96-.43.96-.96zm-12.82.64V5.38c.574.33.96.95.96 1.66 0 1.06-.86 1.92-1.922 1.92-1.06 0-1.92-.86-1.92-1.92 0-.71.39-1.33.96-1.66v1.66c0 .53.43.96.96.96s.96-.43.96-.96z"/>
					</svg>
					<span><?= lang('form.step_lbl')?></span>
				</h2>
				<div class="grayBox">
					<?php foreach($campaign_steps as $campaign_step_id => $campaign_step) : ?>
						<div class="row">
							<div class="col-sm-12">
								<label for="creation<?php echo $campaign_step_id; ?>" id="label_creation<?php echo $campaign_step_id; ?>"><?php echo $campaign_step; ?></label>
							</div>
						</div>
					
						<div class="row">
							<div class="col-sm-6">
								<input class="datechooser" type="text" name="campaign_step_date_start[<?php echo $campaign_step_id; ?>]" id="campaign_step_date_start<?php echo $campaign_step_id; ?>" value="<?php if (isset($campaign_steps_data[$campaign_step_id])) echo date('d/m/Y', strtotime($campaign_steps_data[$campaign_step_id]->campaign_step_date_start)); ?>"/>
							</div>
							<div class="col-sm-6 etapes-au">
								<input class="datechooser" type="text" name="campaign_step_date_end[<?php echo $campaign_step_id; ?>]" id="campaign_step_date_end<?php echo $campaign_step_id; ?>" value="<?php if (isset($campaign_steps_data[$campaign_step_id])) echo date('d/m/Y', strtotime($campaign_steps_data[$campaign_step_id]->campaign_step_date_end)); ?>"/>
							</div>
						</div>
					<?php endforeach; ?>
					<div class="row">
						<div class="col-sm-6">
							<label for="campaign_date_media" id="label_campaign_date_media_start"><?= lang('form.media_start_date_lbl')?></label>
							<input class="datechooser" type="text" name="campaign_date_media_start" id="campaign_date_media_start" value="<?php if (isset($campaign->campaign_date_media_start) && $campaign->campaign_date_media_start != '0000-00-00' ) { echo date('d/m/Y', strtotime($campaign->campaign_date_media_start)); } ?>" data-type="text"/>
						</div>
						<div class="col-sm-6">
							<label for="campaign_date_media" id="label_campaign_date_media_end"><?= lang('form.media_end_date_lbl')?></label>
							<input class="datechooser" type="text" name="campaign_date_media_end" id="campaign_date_media_end" value="<?php if (isset($campaign->campaign_date_media_end) && $campaign->campaign_date_media_end != '0000-00-00' ) { echo date('d/m/Y', strtotime($campaign->campaign_date_media_end)); } ?>" data-type="text"/>
						</div>						
					</div>
					
					
				</div>
			</div>
		</div>
		<div class="btn-bottom-hr">
		<hr />
			<a style="cursor:pointer;" class="submit_form btn-icon-on-dark submit" data-value="campaign_edit">
			<svg class="icon-svg icon-sauvegarderBlanc" viewBox="0 0 31 32" x="1920">
				<path fill="#FFF" d="M22.652.35v8.792H6.1V.352H0V32h30.493V5.95l-4.68-5.6h-3.16zM4.356 13.54h20.91v13.187H4.356v-13.19z"/>
				<path fill="#FFF" d="M8.712 6.505h11.326V.35H8.712v6.155z"/>
			</svg>
			<?= lang('form.save_btn')?>
			</a>
		</div>
		</form>
	</div>
	<input type="hidden" id="error_message" value="<?php echo lang('campaign.edit.error'); ?>">
</section>
