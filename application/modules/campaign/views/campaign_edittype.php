<article class="module width_full">
	<header><h3><?php echo lang('campaign.edit.type'); ?></h3></header>
	<form id="permissions_form" method="post" action="<?php echo site_url('campaign/process_type'); ?>">
	<div class="module_content">
		<fieldset>
			<label><?php echo lang('campaign.type.name'); ?></label>
				<td><input type="text" id="campaign_type_name" name="campaign_type_name" value="<?php if (isset($type->campaign_type_name)) echo $type->campaign_type_name; ?>" data-validate="required" data-type="text" title="<?php echo lang('campaign.name'); ?>"></td>
		</fieldset>
		<fieldset>
			<label><?php echo lang('campaign.color'); ?></label>
				<td><input type="text" id="campaign_type_color" name="campaign_type_color" value="<?php if (isset($type->campaign_type_color)) echo $type->campaign_type_color; ?>" data-validate="required" data-type="text" title="<?php echo lang('campaign.color'); ?>"></td>
				<label for="background-color"><label><?php echo lang('general.color'); ?></label></label>
				<input type="color" onchange="javascript:document.getElementById('campaign_type_color').value = document.getElementById('campaign_type_background_color').value;" value="<?php echo $type->campaign_type_color; ?>" id="campaign_type_background_color">
		</fieldset>
		<fieldset>
			<label><?php echo lang('user.status'); ?></label>
			<?php echo form_dropdown('campaign_type_active', $status, $type->campaign_type_active); ?>
		</fieldset>
		<div class="clear"></div>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_permission" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
				<input type="hidden" id="active_lang" name="active_lang" value="en">
				<input type="hidden" id="campaign_type_id" name="campaign_type_id" value="<?php echo $type->campaign_type_id; ?>">
			</div>
		</footer>
	</form>
	<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
	<input type="hidden" id="error_message" value="">
	<input type="hidden" id="permission_number" value="0">
</article><!-- end of article -->
