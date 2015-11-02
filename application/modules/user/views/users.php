<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('user.users'); ?></h3></header>
	<div class="tab_container">
		<table class="tablesorter" cellspacing="0"> 
		<thead> 
			<tr> 
				<th><?php echo lang('user.firstname'); ?></th>
				<th><?php echo lang('user.lastname'); ?></th>
				<th><?php echo lang('user.email'); ?></th>
				<th><?php echo lang('user.status'); ?></th>
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
					<td><?php echo $item->user_firstname ?></td>
					<td><?php echo $item->user_lastname ?></td>
					<td><?php echo $item->user_email ?></td>
					<td><?php echo lang(item(get_status_list(), ord($item->user_active))); ?></td>
					<?php if ($this->session->userdata('user_permission') <= 2) : ?>
					<td>
						<?php echo anchor('user/edituser/'.$item->user_id, '<input type="image" src="'.site_url().'assets/images/icn_edit.png" title="'.lang('user.edit').'">'); ?>
						<input class="trash" data-userid="<?php echo $item->user_id; ?>" type="image" src="<?php echo site_url(); ?>assets/images/icn_trash.png" title="<?php echo lang('user.delete'); ?>">
						<a class="deletebutton" id="delete_<?php echo $item->user_id; ?>" href="<?php echo site_url('user/delete_user/'.$item->user_id); ?>"><?php echo lang('user.delete.confirm'); ?></a></span>
					</td>
					<?php endif; ?>
				</tr>
			<?php endforeach ?>
		</tbody> 
		</table>
	</div><!-- end of .tab_container -->
</article><!-- end of article -->
