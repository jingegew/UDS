<div class="entityAttributeValues row">
<div class="actions span2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>

		<li><?php echo $this->Html->link(__('List Entity Attribute Values'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Attributes'), array('controller' => 'attributes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribute'), array('controller' => 'attributes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="entityAttributeValues span10">
<?php echo $this->Form->create('EntityAttributeValue', array('class' => 'form-horizontal'));?>
	<fieldset>
		<legend><?php echo __('Add Entity Attribute Value'); ?></legend>
	<?php
		echo $this->Form->input('entity_id');
		echo $this->Form->input('attribute_id');
		echo $this->Form->input('value');
		echo $this->Form->input('entity_type');
	?>
		<div class="form-actions">
<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'attributes', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
		</div>
		</fieldset>
<?php echo $this->Form->end();?>
</div>
</div>