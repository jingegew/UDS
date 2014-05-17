<div class="entityAttributeValues index row">
<div class="actions span2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>
		<li><?php echo $this->Html->link(__('New Entity Attribute Value'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Attributes'), array('controller' => 'attributes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribute'), array('controller' => 'attributes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="span10">
	<h2><?php echo __('Entity Attribute Values');?></h2>
	<table class="table table-condensed" style="white-space:nowrap;">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('entity_id');?></th>
			<th><?php echo $this->Paginator->sort('attribute_id');?></th>
			<th><?php echo $this->Paginator->sort('value');?></th>
			<th><?php echo $this->Paginator->sort('entity_type');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($entityAttributeValues as $entityAttributeValue): ?>
	<tr>
		<td><?php echo h($entityAttributeValue['EntityAttributeValue']['id']); ?>&nbsp;</td>
		<td><?php echo h($entityAttributeValue['EntityAttributeValue']['entity_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($entityAttributeValue['Attribute']['name'], array('controller' => 'attributes', 'action' => 'view', $entityAttributeValue['Attribute']['id'])); ?>
		</td>
		<td><?php echo h($entityAttributeValue['EntityAttributeValue']['value']); ?>&nbsp;</td>
		<td><?php echo h($entityAttributeValue['EntityAttributeValue']['entity_type']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $entityAttributeValue['EntityAttributeValue']['id']), array('class' => 'btn btn-mini')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $entityAttributeValue['EntityAttributeValue']['id']), array('class' => 'btn btn-mini')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $entityAttributeValue['EntityAttributeValue']['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $entityAttributeValue['EntityAttributeValue']['id'])); ?>
				</div>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
    <div class="well">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</div>

	<div class="paging btn-group">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array('class' => 'prev btn'), null, array('class' => 'prev disabled btn'));
		echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn', 'currentClass' => 'active'));
		echo $this->Paginator->next(__('next') . ' >', array('class' => 'next btn'), null, array('class' => 'next disabled btn'));
	?>
	</div>
</div>
</div>

