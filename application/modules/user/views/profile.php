<article class="module width_full">
	<header><h3><?php echo lang('user.profile'); ?></h3></header>
	<form id="user_profile" method="post" action="<?php echo site_url('user/process_profile'); ?>">
		<div class="module_content">
			<fieldset >
				<label><?php echo lang('user.client'); ?></label>
				<?php echo form_dropdown('client_id', $clients, $user->client_id, 'style="width:92%;"'); ?>
			</fieldset>			
			<fieldset>
				<label><?php echo lang('user.firstname'); ?></label>
				<input type="text" name="user_firstname" id="user_firstname" value="<?php echo $user->user_firstname; ?>" data-validate="required" data-type="text" title="<?php echo lang('user.firstname'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('user.lastname'); ?></label>
				<input type="text" name="user_lastname" id="user_lastname" value="<?php echo $user->user_lastname; ?>" data-validate="required" data-type="text" title="<?php echo lang('user.lastname'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('user.email'); ?></label>
				<input type="text" name="user_email" id="user_email" value="<?php echo $user->user_email; ?>" data-validate="required" data-type="email" title="<?php echo lang('user.email'); ?>">
			</fieldset>
			<?php 
				if ($this->session->userdata['user_permission'] == 1) 
				{
			?>
					<fieldset style="width:48%; float:left; margin-right: 3%;">
						<label><?php echo lang('user.permissions'); ?></label>
						<?php echo form_dropdown('user_permission', $permissions, $user->user_permission, 'style="width:92%;"'); ?>
					</fieldset>
			<?php 
				}
			?>
			<fieldset style="width:48%; float:left;">
				<label><?php echo lang('user.status'); ?></label>
				<?php echo form_dropdown('user_active', $status, $user->user_active); ?>
			</fieldset>			
			<div class="clear"></div>
		</div>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_user_profile" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
				<input type="hidden" name="user_id" id="user_id" value="<?php echo $user->user_id; ?>">
				<input type="hidden" id="email_exists_url" value="<?php echo site_url('user/email_exists'); ?>">
			</div>
		</footer>
	</form>
</article><!-- end of post new article -->
<article class="module width_full">
	<header><h3><?php echo lang('user.password'); ?></h3></header>
	<form id="user_password" method="post" action="<?php echo site_url('user/process_password'); ?>">
		<div class="module_content">
			<fieldset>
				<label><?php echo lang('user.oldpassword'); ?></label>
				<input type="password" name="user_oldpassword" id="user_oldpassword" value="" data-validate="required" data-type="text" title="<?php echo lang('user.oldpassword'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('user.newpassword'); ?></label>
				<input type="password" name="user_newpassword" id="user_newpassword" value="" data-validate="required" data-type="text" title="<?php echo lang('user.newpassword'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('user.newpassword'); ?></label>
				<input type="password" name="user_confirm_newpassword" id="user_confirm_newpassword" value="" data-validate="required" data-type="text" title="<?php echo lang('user.newpassword'); ?>">
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
</article><!-- end of article -->
