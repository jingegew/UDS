<div class="agencies row">
<div class="actions span2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>

		<li><?php echo $this->Html->link(__('List Agencies'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Grants'), array('controller' => 'grants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grant'), array('controller' => 'grants', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="agencies span10">
<?php echo $this->Form->create('Agency', array('class' => 'form-horizontal'));?>
	<fieldset>
		<legend><?php echo __('Add Agency'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
		<div class="form-actions">
<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'grants', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
		</div>
		</fieldset>
<?php echo $this->Form->end();?>
</div>
</div>