<h4>View Grant</h4>

<table class="table table-striped table-bordered bootstrap-datatable">	
<thead> 
	<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Description</th>
			<th>Agency</th>
			<th>Start Time</th>
			<th>End Time</th>
	</tr>
	</thead> 
	<tbody> 
	<tr>
		<td><?php echo $grant['Grant']['id']; ?>&nbsp;</td>
		<td><?php echo h($grant['Grant']['name']); ?>&nbsp;</td>
		<td><?php echo h($grant['Grant']['description']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($grant['Agency']['name'], array('controller' => 'agencies', 'action' => 'view', $grant['Agency']['id'])); ?>
			&nbsp;
		</td>
		<td><?php echo h($grant['Grant']['start_time']); ?>&nbsp;</td>
		<td><?php echo h($grant['Grant']['end_time']); ?>&nbsp;</td>
	</tr>
</tbody>
</table>	
<div>
<h4>Project List</h4>
	<?php if (!empty($grant['Project'])):?>
		<table class="table table-striped table-bordered bootstrap-datatable">
		<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Start Time'); ?></th>
		<th><?php echo __('End Time'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($grant['Project'] as $project): ?>
		<tr>
			<td><?php echo $project['id'];?></td>
			<td><?php echo $project['name'];?></td>
			<td><?php echo $project['description'];?></td>
			<td><?php echo $project['start_time'];?></td>
			<td><?php echo $project['end_time'];?></td>
			<td><?php echo $project['user_id'];?></td>			
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>
