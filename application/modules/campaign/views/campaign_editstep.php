<article class="module width_full">
	<header><h3><?php echo lang('campaign.edit.step'); ?></h3></header>
	<form id="permissions_form" method="post" action="<?php echo site_url('campaign/process_step'); ?>">
	<div class="module_content">
		<fieldset>
			<label><?php echo lang('campaign.step.name'); ?></label>
				<td><input type="text" id="campaign_step_name" name="campaign_step_name" value="<?php if (isset($step->campaign_step_name)) echo $step->campaign_step_name; ?>" data-validate="required" data-type="text" title="<?php echo lang('campaign.name'); ?>"></td>
			</fieldset>
		<fieldset>
			<label><?php echo lang('campaign.status'); ?></label>
			<?php echo form_dropdown('campaign_step_active', $status, $step->campaign_step_active); ?>
		</fieldset>
		<div class="clear"></div>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_permission" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
				<input type="hidden" id="active_lang" name="active_lang" value="en">
				<input type="hidden" id="campaign_step_id" name="campaign_step_id" value="<?php echo $step->campaign_step_id; ?>">
			</div>
		</footer>
	</form>
	<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
	<input type="hidden" id="error_message" value="">
	<input type="hidden" id="permission_number" value="0">
</article><!-- end of article -->
