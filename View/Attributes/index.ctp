<h4><?php echo __('Attributes');?></h4>

<?php 
$project = $this->Session->read('Project.name');
if(!isset($project)):?>
<div class="row-fluid">
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><?php echo __('No Project Selected!');?></h4>
  <?php echo __('Please select a project which you would like working on by clicking Projects menu on the left.');?>
</div>
</div>
<?php else: ?>

	<table class="table bootstrap-datatable">
	<tr>
		<th><?php echo $this->Paginator->sort('id');?></th>
		<th><?php echo $this->Paginator->sort('name');?></th>
		<th><?php echo $this->Paginator->sort('type');?></th>
		<th><?php echo $this->Paginator->sort('display');?></th>			
		<th><?php echo $this->Paginator->sort('description');?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($attributes as $attribute): ?>
	<tr>
		<td><?php echo h($attribute['Attribute']['id']); ?>&nbsp;</td>
		<td><?php echo h($attribute['Attribute']['name']); ?>&nbsp;</td>
		<td><?php echo h($attribute['Attribute']['type']); ?>&nbsp;</td>
		<td><?php echo h($attribute['Attribute']['display']); ?>&nbsp;</td>
		<td><?php echo h($attribute['Attribute']['description']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $attribute['Attribute']['id']), array('class' => 'btn btn-mini')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $attribute['Attribute']['id']), array('class' => 'btn btn-mini')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $attribute['Attribute']['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $attribute['Attribute']['id'])); ?>
				</div>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
<div class="row_fluid">
<div class="pull-left">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	
</div>

<div class="paging btn-group pull-right">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array('class' => 'prev btn'), null, array('class' => 'prev disabled btn'));
		echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn', 'currentClass' => 'active'));
		echo $this->Paginator->next(__('next') . ' >', array('class' => 'next btn'), null, array('class' => 'next disabled btn'));
	?>
</div>
</div>


<br/>
<br/>
<!-- Button to trigger modal -->
<div> 
	<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal"><?php echo __('New Attribute');?></a>
</div>
<?php endif; ?>
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
    <h3 id="myModalLabel"><?php echo __('Add Attribute');?></h3>
  </div>
  <form accept-charset="utf-8" method="post" id="AttributeIndexForm" action="/uds/attributes/add">
  <?php echo $this->Form->create('Attribute', array('action' => 'add'));?>
  <div class="modal-body">
	<fieldset>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('type');
		echo $this->Form->input('display');
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