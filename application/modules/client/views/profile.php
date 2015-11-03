<article class="module width_full">
	<header><h3><?php echo lang('client.profile'); ?></h3></header>
	<form id="user_profile" method="post" action="<?php echo site_url('client/process_profile'); ?>">
		<div class="module_content">
			<fieldset>
				<label><?php echo lang('client.name'); ?></label>
				<input type="text" name="client_name" id="client_name" value="<?php echo $user->client_name; ?>" data-validate="required" data-type="text" title="<?php echo lang('client.name'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('client.logo'); ?></label>
				<input type="text" name="client_logo" id="client_logo" value="<?php echo $user->client_logo; ?>" data-validate="required" data-type="text" title="<?php echo lang('client.logo'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('client.primary_color'); ?></label>
				<input type="text" name="client_primary_color" id="client_primary_color"  class="color" value="<?php echo $user->client_primary_color; ?>" data-validate="required" data-type="text" title="<?php echo lang('client.primary_color'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('client.secondary_color'); ?></label>
				<input type="text" name="client_secondary_color" id="client_secondary_color" class="color" value="<?php echo $user->client_secondary_color; ?>" data-validate="required" data-type="text" title="<?php echo lang('client.secondary_color'); ?>">
			</fieldset>	
			<fieldset>
				<label><?php echo lang('client.font_primary_color'); ?></label>				
				<input type="text" name="client_font_primary_color" id="client_font_primary_color" class="color" value="<?php echo $user->client_font_primary_color; ?>" data-validate="required" data-type="text" title="<?php echo lang('client.font_primary_color'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('client.font_secondary_color'); ?></label>
				<input type="text" name="client_font_secondary_color" id="client_font_secondary_color" class="color" value="<?php echo $user->client_font_secondary_color; ?>" data-validate="required" data-type="text" title="<?php echo lang('client.font_secondary_color'); ?>">
			</fieldset>		
			<fieldset style="width:48%; float:left;">
				<label><?php echo lang('client.status'); ?></label>		
				<?php echo form_dropdown('client_active', $status, $user->client_active); ?>
			</fieldset>									
			<div class="clear"></div>
		</div>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_user_profile" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
				<input type="hidden" name="client_id" id="client_id" value="<?php echo $user->client_id; ?>">
			</div>
		</footer>
	</form>
</article><!-- end of post new article -->
<? /*<article class="module width_full">
	<header><h3><?php echo lang('client.password'); ?></h3></header>
	<form id="user_password" method="post" action="<?php echo site_url('user/process_password'); ?>">
		<div class="module_content">
			<fieldset>
				<label><?php echo lang('client.oldpassword'); ?></label>
				<input type="password" name="user_oldpassword" id="user_oldpassword" value="" data-validate="required" data-type="text" title="<?php echo lang('client.oldpassword'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('client.newpassword'); ?></label>
				<input type="password" name="user_newpassword" id="user_newpassword" value="" data-validate="required" data-type="text" title="<?php echo lang('client.newpassword'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('client.newpassword'); ?></label>
				<input type="password" name="user_confirm_newpassword" id="user_confirm_newpassword" value="" data-validate="required" data-type="text" title="<?php echo lang('client.newpassword'); ?>">
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
