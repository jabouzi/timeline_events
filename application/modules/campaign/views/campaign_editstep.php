<article class="module width_full">
	<header><h3><?php echo lang('user.edit'); ?></h3></header>
	<form id="permissions_form" method="post" action="<?php echo site_url('campaign/process_step'); ?>">
	<div class="module_content">
		<?php $index = 0; ?>
		<?php foreach($languages as $code => $language) : ?>
			<div id="<?php echo $code; ?>" class="tab_content">
				<div class="tab_container">
					<fieldset>
						<label><?php echo lang('user.permissions'); ?></label>
						<td><input type="text" id="campaign_step_name_<?php echo $code; ?>_<?php if (isset($step->campaign_step_name[$code])) echo $step->campaign_step_name[$code]; ?>" name="campaign_step_name[<?php echo $code; ?>]" value="<?php if (isset($step->campaign_step_name[$code])) echo $step->campaign_step_name[$code]; ?>" data-validate="required" data-type="text" title="<?php echo lang('permission.name'); ?>"></td>
					</fieldset>
				</div><!-- end of .tab_container -->
			</div>			
			<?php $index++; ?>
		<?php endforeach; ?>
			<fieldset>
				<label><?php echo lang('user.status'); ?></label>
				<?php echo form_dropdown('campaign_step_active', $status, $step->campaign_step_active); ?>
			</fieldset>
			<div class="clear"></div>
		</div>
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
	<div style="display:none" id="new_permission">
		<td><input type="text" name="new[]" value="">
	</div>
</article><!-- end of article -->
