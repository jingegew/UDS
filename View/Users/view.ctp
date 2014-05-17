<div>
<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable">	
<thead> 
	<tr>
			<th>ID</th>
			<th>Last Name</th>
			<th>First Name</th>
			<th>Role</th>
			<th>Email</th>
			<th>Username</th>
			<th>Status</th>
			<th>Description</th>
	</tr>
	</thead> 
	<tbody> 
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($user['Role']['name'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>&nbsp;
		</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php  
				if($user['User']['status']){
					echo '<span class="label label-success">Active</span>';
				} else {
					echo '<span class="label">Inactive</span>';;
				}
			?>&nbsp;</td>
		<td><?php echo h($user['User']['description']); ?>&nbsp;</td>
	</tr>
</tbody>
</table>
</div>

<div>
<h4><?php echo __('Privilege Control List');?></h4>
<?php if (!empty($user['Privilege'])):?>
	<table class="table table-striped table-bordered bootstrap-datatable">
		<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Project Id'); ?></th>
		<th><?php echo __('Experiment Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
		</tr>
		<?php foreach ($user['Privilege'] as $privilege): ?>
		<tr>
			<td><?php echo $privilege['id'];?></td>
			<td><?php echo $privilege['user_id'];?></td>
			<td><?php echo $privilege['project_id'];?></td>
			<td><?php echo $privilege['experiment_id'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'privileges', 'action' => 'view', $privilege['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'privileges', 'action' => 'edit', $privilege['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'privileges', 'action' => 'delete', $privilege['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $privilege['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>
</div>