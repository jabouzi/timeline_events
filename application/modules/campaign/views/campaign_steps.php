<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('campaign.steps'); ?></h3></header>
	<div class="tab_container">
		<table class="tablesorter" cellspacing="0"> 
		<thead> 
			<tr> 
				<th><?php echo lang('manager.name'); ?></th>
				<th><?php echo lang('manager.status'); ?></th>
				<?php if ($this->session->userdata('user_permission') < 2) : ?>
					<th><?php echo lang('admin.action'); ?></th>
				<?php endif; ?>
			</tr> 
		</thead> 
		<tbody id="workflow_list">
			<?php foreach ($steps as $item) : ?>
				<tr>
					<td style="width:40%"><?php echo $item->campaign_step_name ?></td>
					<td style="width:40%"><?php echo lang(item(get_client_status_list(), $item->campaign_step_active)); ?></td>
					<?php
					 if ($this->session->userdata('user_permission') < 2) : ?>
					<td>
					<?php echo anchor('manager/editprojectmanager/'.$item->campaign_step_id, '<img  src="'.site_url().'assets/images/icn_edit.png" title="'.lang('manager.edit').'">'); ?>
						<input class="trash" data-userid="<?php echo $item->campaign_step_id; ?>" type="image" src="<?php echo site_url(); ?>assets/images/icn_trash.png" title="<?php echo lang('manager.delete'); ?>">
						<a class="deletebutton" id="delete_<?php echo $item->campaign_step_id; ?>" href="<?php echo site_url('manager/delete_manager/'.$item->campaign_step_id); ?>"><?php echo lang('general.delete.confirm'); ?></a>
					</td>
					<?php endif; 
					?>
				</tr>
			<?php endforeach ?>
		</tbody> 
		</table>
	</div><!-- end of .tab_container -->
</article><!-- end of article -->
