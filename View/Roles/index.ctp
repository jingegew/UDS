<h4>Roles</h4>
<table class="table table-striped bootstrap-datatable" style="white-space:nowrap;">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
	</tr>
	<?php
	foreach ($roles as $role): ?>
	<tr>
		<td><?php echo h($role['Role']['id']); ?>&nbsp;</td>
		<td><?php echo h($role['Role']['name']); ?>&nbsp;</td>
		<td><?php echo h($role['Role']['description']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
</table>