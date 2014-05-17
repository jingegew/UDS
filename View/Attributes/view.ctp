<div>		
		<h4>Attribute</h4>
		<dl>
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($attribute['Attribute']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($attribute['Attribute']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($attribute['Attribute']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($attribute['Attribute']['description']); ?>
			&nbsp;
		</dd>
		</dl>
</div>

<h3><?php echo __('Related Entity Attribute Values');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Entity Attribute Value'), array('controller' => 'entity_attribute_values', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($attribute['EntityAttributeValue'])):?>
			<table class="table table-striped table-bordered bootstrap-datatable">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entity Id'); ?></th>
		<th><?php echo __('Attribute Id'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Entity Type'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($attribute['EntityAttributeValue'] as $entityAttributeValue): ?>
		<tr>
			<td><?php echo $entityAttributeValue['id'];?></td>
			<td><?php echo $entityAttributeValue['entity_id'];?></td>
			<td><?php echo $entityAttributeValue['attribute_id'];?></td>
			<td><?php echo $entityAttributeValue['value'];?></td>
			<td><?php echo $entityAttributeValue['entity_type'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'entity_attribute_values', 'action' => 'view', $entityAttributeValue['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'entity_attribute_values', 'action' => 'edit', $entityAttributeValue['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'entity_attribute_values', 'action' => 'delete', $entityAttributeValue['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $entityAttributeValue['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>