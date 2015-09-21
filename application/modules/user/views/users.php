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
				<th><?php echo lang('admin.action'); ?></th>
			</tr> 
		</thead> 
		<tbody id="workflow_list">
			<?php foreach ($user->result() as $item) : ?>
				<tr>
					<td><?php echo $item->user_firstname ?></td>
					<td><?php echo $item->user_lastname ?></td>
					<td><?php echo $item->user_email ?></td>
					<td><?php echo lang('admin.status'.ord($item->user_active)); ?></td>
					<td>
						<?php echo anchor('user/edituser/'.$item->user_id, '<input type="image" src="<?php echo site_url(); ?>assets/images/icn_edit.png" title="'.lang('user.edit').'">'); ?>
						<input type="image" src="<?php echo site_url(); ?>assets/images/icn_trash.png" title="<?php echo lang('user.delete'); ?>">
					</td>
				</tr>
			<?php endforeach ?>
		</tbody> 
		</table>
	</div><!-- end of .tab_container -->
</article><!-- end of article -->
