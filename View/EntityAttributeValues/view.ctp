<div class="entityAttributeValues view row">
	<div class="actions span2">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Entity Attribute Value'), array('action' => 'edit', $entityAttributeValue['EntityAttributeValue']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Entity Attribute Value'), array('action' => 'delete', $entityAttributeValue['EntityAttributeValue']['id']), null, __('Are you sure you want to delete # %s?', $entityAttributeValue['EntityAttributeValue']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Entity Attribute Values'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entity Attribute Value'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attributes'), array('controller' => 'attributes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribute'), array('controller' => 'attributes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="span10">
		<h2><?php  echo __('Entity Attribute Value');?></h2>
		<dl>
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($entityAttributeValue['EntityAttributeValue']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Entity Id'); ?></dt>
		<dd>
			<?php echo h($entityAttributeValue['EntityAttributeValue']['entity_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attribute'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entityAttributeValue['Attribute']['name'], array('controller' => 'attributes', 'action' => 'view', $entityAttributeValue['Attribute']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($entityAttributeValue['EntityAttributeValue']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Entity Type'); ?></dt>
		<dd>
			<?php echo h($entityAttributeValue['EntityAttributeValue']['entity_type']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
