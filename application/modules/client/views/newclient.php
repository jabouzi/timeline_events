<article class="module width_full">
	<header><h3><?php echo lang('client.new'); ?></h3></header>
	<form id="user_profile" method="post" enctype="multipart/form-data" action="<?php echo site_url('client/process_newclient'); ?>">
		<div class="module_content">			
			<fieldset>
				<label><?php echo lang('client.name'); ?></label>
				<input type="text" name="client_name" id="client_name" value="<?php echo $this->input->post('client_name'); ?>" data-validate="required" data-type="text" title="<?php echo lang('client.name'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('client.logo'); ?></label>
				<input type="file" name="client_logo" id="client_logo" value="<?php echo $this->input->post('client_logo'); ?>" data-validate="required" data-type="text" title="<?php echo lang('client.logo'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('client.primary_color'); ?></label>				
				<input type="text" name="client_primary_color" id="client_primary_color" class="color" value="<?php echo $this->input->post('client_primary_color'); ?>" data-validate="required" data-type="text" title="<?php echo lang('client.primary_color'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('client.secondary_color'); ?></label>
				<input type="text" name="client_secondary_color" id="client_secondary_color" class="color" value="<?php echo $this->input->post('client_secondary_color'); ?>" data-validate="required" data-type="text" title="<?php echo lang('client.secondary_color'); ?>">
			</fieldset>	
			<fieldset>
				<label><?php echo lang('client.font_primary_color'); ?></label>				
				<input type="text" name="client_font_primary_color" id="client_font_primary_color" class="color" value="<?php echo $this->input->post('client_font_primary_color'); ?>" data-validate="required" data-type="text" title="<?php echo lang('client.font_primary_color'); ?>">
			</fieldset>
			<fieldset>
				<label><?php echo lang('client.font_secondary_color'); ?></label>
				<input type="text" name="client_font_secondary_color" id="client_font_secondary_color" class="color" value="<?php echo $this->input->post('client_font_secondary_color'); ?>" data-validate="required" data-type="text" title="<?php echo lang('client.font_secondary_color'); ?>">
			</fieldset>					
			<fieldset style="width:48%; float:left;">
				<label><?php echo lang('client.status'); ?></label>
				<?php echo form_dropdown('client_active', $status, $this->input->post('client_active')); ?>
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
