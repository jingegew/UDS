<div class="responses row">
<div class="actions span2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>

		<li><?php echo $this->Html->link(__('List Responses'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Participants'), array('controller' => 'participants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Participant'), array('controller' => 'participants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stimuli'), array('controller' => 'stimuli', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stimulus'), array('controller' => 'stimuli', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Experiments'), array('controller' => 'experiments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Experiment'), array('controller' => 'experiments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stimulus Conditions'), array('controller' => 'stimulus_conditions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stimulus Condition'), array('controller' => 'stimulus_conditions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="responses span10">
<?php echo $this->Form->create('Response', array('class' => 'form-horizontal'));?>
	<fieldset>
		<legend><?php echo __('Add Response'); ?></legend>
	<?php
		echo $this->Form->input('participant_id');
		echo $this->Form->input('stimulus_id');
		echo $this->Form->input('experiment_id');
		echo $this->Form->input('stimulus_condition_id');
		echo $this->Form->input('start_time');
		echo $this->Form->input('end_time');
		echo $this->Form->input('misc_note');
		echo $this->Form->input('response_value');
	?>
		<div class="form-actions">
<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => 'stimulus_conditions', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
		</div>
		</fieldset>
<?php echo $this->Form->end();?>
</div>
</div>