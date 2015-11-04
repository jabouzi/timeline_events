<article class="module width_full">
	<header><h3><?php echo lang('tonik.new'); ?></h3></header>
	<form id="user_profile" method="post" enctype="multipart/form-data" action="<?php echo site_url('tonik/process_newprojectmanager'); ?>">
		<div class="module_content">			
			<fieldset>
				<label><?php echo lang('tonik.name'); ?></label>
				<input type="text" name="campaign_manager_name" id="campaign_manager_name" value="<?php echo $this->input->post('campaign_manager_name'); ?>" data-validate="required" data-type="text" title="<?php echo lang('tonik.name'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('tonik.lastname'); ?></label>
				<input type="text" name="campaign_manager_lastname" id="campaign_manager_lastname" value="<?php echo $this->input->post('campaign_manager_lastname'); ?>" data-validate="required" data-type="text" title="<?php echo lang('tonik.lastname'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('tonik.email'); ?></label>				
				<input type="text" name="campaign_manager_email" id="campaign_manager_email" value="<?php echo $this->input->post('campaign_manager_email'); ?>" data-validate="required" data-type="text" title="<?php echo lang('tonik.email'); ?>">
			</fieldset>
					
			<fieldset style="width:48%; float:left;">
				<label><?php echo lang('tonik.status'); ?></label>
				<?php echo form_dropdown('campaign_manager_active', $status, $this->input->post('campaign_manager_active')); ?>
			</fieldset>
			<div class="clear"></div>
		</div>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_user_profile" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
				<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
				<input type="hidden" id="error_message" value="">				
			</div>
		</footer>
	</form>
</article><!-- end article -->