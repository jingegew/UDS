<table class="table table-striped bootstrap-datatable datatable dataTable">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($agencies as $agency): ?>
	<tr>
		<td><?php echo h($agency['Agency']['id']); ?>&nbsp;</td>
		<td><?php echo h($agency['Agency']['name']); ?>&nbsp;</td>
		<td><?php echo h($agency['Agency']['description']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $agency['Agency']['id']), array('class' => 'btn btn-mini')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $agency['Agency']['id']), array('class' => 'btn btn-mini')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $agency['Agency']['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $agency['Agency']['id'])); ?>
				</div>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
</table>

<!-- Button to trigger modal -->
<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal"><?php echo __('Add Agency');?></a>
 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel"><?php echo __('Add Agency');?></h3>
  </div>
  <form accept-charset="utf-8" method="post" id="AgencyIndexForm" action="/uds/agencies/add">
  <div class="modal-body">
	<fieldset>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
	

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Close');?></button>
    <button type="submit" class="btn btn-primary"><?php echo __('Add');?></button>
  </div>
  </form>
</div>