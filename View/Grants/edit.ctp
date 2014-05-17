<?php echo $this->Form->create('Grant', array('class' => 'form-horizontal'));?>
	<fieldset>
		<legend><?php echo __('Edit Grant'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('agency_id');
		echo $this->Form->input('start_time');
		echo $this->Form->input('end_time');
	?>
		<br/>
		<div class="actions">
<?php echo $this->Form->submit(__('Save'),array('class'=>'btn btn-primary','div'=>false));?>
		</div>
		</fieldset>
<?php echo $this->Form->end();?>