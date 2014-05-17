<div>
<?php echo $this->Form->create('Privilege', array('class' => 'form-horizontal'));?>
	<fieldset>
		<legend><?php echo __('Edit Privilege'); ?></legend>
	<?php
		echo $this->Form->input('role');
		echo $this->Form->input('data_limit');
		echo $this->Form->input('start_time', array('type' => 'text', 'class' => 'input-small datepicker', 'placeholder' => date("Y-m-d")));
		echo $this->Form->input('end_time', array('type' => 'text', 'class' => 'input-small datepicker', 'placeholder' => "2015-12-31"));
	?>
		<div class="form-actions">
<?php echo $this->Form->submit(__('Save'),array('class'=>'btn btn-primary','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'experiments', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
		</div>
		</fieldset>
<?php echo $this->Form->end();?>
</div>