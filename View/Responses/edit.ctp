<?php echo $this->Form->create('Response', array('class' => 'form-horizontal'));?>
	<fieldset>
		<legend><?php echo __('Edit Response'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('participant_id');
		echo $this->Form->input('stimulus_id');
		echo $this->Form->input('experiment_id');
		echo $this->Form->input('date');
		echo $this->Form->input('start_time');
		echo $this->Form->input('end_time');
		echo $this->Form->input('misc_note');
		echo $this->Form->input('response_value');
	?>
	<br/>
<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary','div'=>false));?>
		</fieldset>
<?php echo $this->Form->end();?>