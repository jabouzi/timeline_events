<article class="module width_full">
	<header><h3><?php echo lang('banner.edit'); ?></h3></header>
	<form id="banner_profile" method="post" action="<?php echo site_url('banner/process_newbanner'); ?>">
		<div class="module_content">
			<fieldset>
				<label><?php echo lang('banner.name'); ?></label>
				<input type="text" name="campaign_banner_name" id="campaign_banner_name" value="" data-validate="required" data-type="text" title="<?php echo lang('banner.name'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('banner.client'); ?></label>
				<?php echo form_dropdown('client_id', $clients); ?>
			</fieldset>
			<fieldset>
				<label><?php echo lang('language.title'); ?></label>
				<?php echo form_dropdown('language_id', $languages); ?>
			</fieldset>
			<div class="clear"></div>
		</div>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_banner_profile" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
				<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
				<input type="hidden" id="error_message" value="">
				<input type="hidden" id="banner_exists_url" value="<?php echo site_url('banner/banner_exists'); ?>">
			</div>
		</footer>
	</form>
</article><!-- end article -->
