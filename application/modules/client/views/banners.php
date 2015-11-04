<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('client.banners'); ?></h3></header>
	<div class="tab_container">
		<table class="tablesorter" cellspacing="0"> 
		<thead> 
			<tr> 
				<th><?php echo lang('client.name'); ?></th>	
				<th><?php echo lang('client.title'); ?></th>
				<?php if ($this->session->userdata('user_permission') <= 2) : ?>
					<th><?php echo lang('admin.action'); ?></th>
				<?php endif; ?>
			</tr> 
		</thead> 
		<tbody id="workflow_list">
			<?php
			//var_dump($user);
			?>
			<?php foreach ($user->result() as $item) : ?>
				<tr>
					<td><?php echo $item->campaign_banner_name ?></td>
					<td><?php echo lang(item(get_client_status_list(), ord($item->client_id))); ?></td>
					<?php if ($this->session->userdata('user_permission') <= 2) : ?>
					<td>						
					<?php echo anchor('client/editbanner/'.$item->client_id, '<img  src="'.site_url().'assets/images/icn_edit.png" title="'.lang('client.edit').'">'); ?>						
						<input class="trash" data-userid="<?php echo $item->client_id; ?>" type="image" src="<?php echo site_url(); ?>assets/images/icn_trash.png" title="<?php echo lang('client.delete'); ?>">
						<a class="deletebutton" id="delete_<?php echo $item->client_id; ?>" href="<?php echo site_url('client/delete_banner/'.$item->client_id); ?>"><?php echo lang('client.delete.confirm'); ?></a>
					</td>
					<?php endif; ?>
				</tr>
			<?php endforeach ?>
		</tbody> 
		</table>
	</div><!-- end of .tab_container -->
</article><!-- end of article -->