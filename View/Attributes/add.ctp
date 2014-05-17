<div class="attributes row">
<div class="actions span2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>

		<li><?php echo $this->Html->link(__('List Attributes'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Entity Attribute Values'), array('controller' => 'entity_attribute_values', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entity Attribute Value'), array('controller' => 'entity_attribute_values', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="attributes span10">
<?php echo $this->Form->create('Attribute', array('class' => 'form-horizontal'));?>
	<fieldset>
		<legend><?php echo __('Add Attribute'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('type');
		echo $this->Form->input('description');
	?>
		<div class="form-actions">
<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'entity_attribute_values', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
		</div>
		</fieldset>
<?php echo $this->Form->end();?>
</div>
</div>