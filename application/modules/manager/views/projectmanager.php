<article class="module width_full">
	<header><h3><?php echo lang('manager.profile'); ?></h3></header>
	<form id="user_profile" method="post" action="<?php echo site_url('manager/process_projectmanager'); ?>">
		<div class="module_content">
			<fieldset>
				<label><?php echo lang('manager.name'); ?></label>
				<input type="text" name="campaign_manager_name" id="campaign_manager_name" value="<?php echo $user->campaign_manager_name; ?>" data-validate="required" data-type="text" title="<?php echo lang('manager.name'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('manager.lastname'); ?></label>
				<input type="text" name="campaign_manager_lastname" id="campaign_manager_lastname" value="<?php echo $user->campaign_manager_lastname; ?>" data-validate="required" data-type="text" title="<?php echo lang('manager.lastname'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('manager.email'); ?></label>
				<input type="text" name="campaign_manager_email" id="user_email" value="<?php echo $user->campaign_manager_email; ?>" data-validate="required" data-type="text" title="<?php echo lang('manager.email'); ?>">
			</fieldset>

			<fieldset style="width:48%; float:left; margin-right: 3%;">
				<label><?php echo lang('manager.tgi'); ?></label>
				<?php echo form_dropdown('campaign_manager_tgi', $tgi, $user->campaign_manager_tgi); ?>
			</fieldset>
			
			<fieldset style="width:48%; float:left;">
				<label><?php echo lang('manager.status'); ?></label>
				<?php echo form_dropdown('campaign_manager_active', $status, $user->campaign_manager_active); ?>
			</fieldset>
			<div class="clear"></div>
		</div>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_user_profile" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
				<input type="hidden" name="campaign_manager_id" id="campaign_manager_id" value="<?php echo $user->campaign_manager_id; ?>">
				<input type="hidden" id="email_exists_url" value="<?php echo site_url('manager/email_exists'); ?>">
			</div>
		</footer>
	</form>
</article>
