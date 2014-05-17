<h4>View Agency</h4>

<table class="table table-striped bootstrap-datatable datatable dataTable">	
<thead> 
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Description</th>
	</tr>
	</thead> 
	<tbody> 
	<tr>
		<td><?php echo $agency['Agency']['id']; ?>&nbsp;</td>
		<td><?php echo $agency['Agency']['name']; ?>&nbsp;</td>
		<td><?php echo $agency['Agency']['description']; ?>&nbsp;</td>
	</tr>
</tbody>
</table>	

<h4>Grant List</h4>

	<?php if (!empty($agency['Grant'])):?>
		<table class="table">
		<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Start Time'); ?></th>
		<th><?php echo __('End Time'); ?></th>
		</tr>
		<?php
		foreach ($agency['Grant'] as $grant): ?>
		<tr>
			<td><?php echo $grant['id'];?></td>
			<td><?php echo $grant['name'];?></td>
			<td><?php echo $grant['description'];?></td>
			<td><?php echo $grant['start_time'];?></td>
			<td><?php echo $grant['end_time'];?></td>
		</tr>
	<?php endforeach; ?>
		</table>
	<?php endif; ?>