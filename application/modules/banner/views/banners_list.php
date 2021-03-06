<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('banner.list'); ?></h3></header>
	<div class="tab_container">
		<table class="tablesorter" cellspacing="0"> 
		<thead> 
			<tr> 
				<th><?php echo lang('banner.name'); ?></th>
				<th><?php echo lang('banner.client'); ?></th>			
				<?php if ($this->session->userdata('user_permission') <= 2) : ?>
					<th><?php echo lang('admin.action'); ?></th>
				<?php endif; ?>
			</tr> 
		</thead> 
		<tbody id="workflow_list">
			<?php foreach ($banners->result() as $item) : ?>
				<tr>
					<td style="width:40%"><?php echo $item->campaign_banner_name ?></td>
					<td style="width:40%"><?php echo $item->client_name ?></td>
					<?php if ($this->session->userdata('user_permission') <= 2) : ?>
					<td>						
					<?php echo anchor('banner/editbanner/'.$item->campaign_banner_id, '<img  src="'.site_url().'assets/images/icn_edit.png" title="'.lang('banner.edit').'">'); ?>						
						<input class="trash" data-userid="<?php echo $item->campaign_banner_id; ?>" type="image" src="<?php echo site_url(); ?>assets/images/icn_trash.png" title="<?php echo lang('banner.delete'); ?>">
						<a class="deletebutton" id="delete_<?php echo $item->campaign_banner_id; ?>" href="<?php echo site_url('banner/delete_banner/'.$item->campaign_banner_id); ?>"><?php echo lang('general.delete.confirm'); ?></a>
					</td>
					<?php endif; ?>
				</tr>
			<?php endforeach ?>
		</tbody> 
		</table>
	</div><!-- end of .tab_container -->
</article><!-- end of article -->

