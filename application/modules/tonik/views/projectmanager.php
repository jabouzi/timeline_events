<article class="module width_full">
	<header><h3><?php echo lang('tonik.profile'); ?></h3></header>
	<form id="user_profile" method="post" action="<?php echo site_url('tonik/process_projectmanager'); ?>">
		<div class="module_content">
			<fieldset>
				<label><?php echo lang('tonik.name'); ?></label>
				<input type="text" name="campaign_manager_name" id="campaign_manager_name" value="<?php echo $user->campaign_manager_name; ?>" data-validate="required" data-type="text" title="<?php echo lang('tonik.name'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('tonik.lastname'); ?></label>
				<input type="text" name="campaign_manager_lastname" id="campaign_manager_lastname" value="<?php echo $user->campaign_manager_lastname; ?>" data-validate="required" data-type="text" title="<?php echo lang('tonik.lastname'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('tonik.email'); ?></label>
				<input type="text" name="campaign_manager_email" id="campaign_manager_email" value="<?php echo $user->campaign_manager_email; ?>" data-validate="required" data-type="text" title="<?php echo lang('tonik.email'); ?>">
			</fieldset>

			<fieldset style="width:48%; float:left;">
				<label><?php echo lang('tonik.status'); ?></label>		
				<?php echo form_dropdown('campaign_manager_active', $status, $user->campaign_manager_active); ?>
			</fieldset>									
			<div class="clear"></div>
		</div>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_user_profile" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
				<input type="hidden" name="campaign_manager_id" id="campaign_manager_id" value="<?php echo $user->campaign_manager_id; ?>">
			</div>
		</footer>
	</form>
</article><!-- end of post new article -->
<? /*<article class="module width_full">
	<header><h3><?php echo lang('tonik.password'); ?></h3></header>
	<form id="user_password" method="post" action="<?php echo site_url('user/process_password'); ?>">
		<div class="module_content">
			<fieldset>
				<label><?php echo lang('tonik.oldpassword'); ?></label>
				<input type="password" name="user_oldpassword" id="user_oldpassword" value="" data-validate="required" data-type="text" title="<?php echo lang('tonik.oldpassword'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('tonik.newpassword'); ?></label>
				<input type="password" name="user_newpassword" id="user_newpassword" value="" data-validate="required" data-type="text" title="<?php echo lang('tonik.newpassword'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('tonik.newpassword'); ?></label>
				<input type="password" name="user_confirm_newpassword" id="user_confirm_newpassword" value="" data-validate="required" data-type="text" title="<?php echo lang('tonik.newpassword'); ?>">
			</fieldset>
			<div class="clear"></div>
		</div>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_user_password" value="<?php echo lang('admin.save'); ?>" class="alt_btn">
				<input type="hidden" name="user_id" id="user_id" value="<?php echo $user->user_id; ?>">
				<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
				<input type="hidden" id="error_message" value="">
				<input type="hidden" id="good_password_url" value="<?php echo site_url('user/good_password'); ?>">
			</div>
		</footer>
	</form>
</article>*/?><!-- end of article -->
