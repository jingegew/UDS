<div class="responses view row">
	<div class="actions span2">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Response'), array('action' => 'edit', $response['Response']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Response'), array('action' => 'delete', $response['Response']['id']), null, __('Are you sure you want to delete # %s?', $response['Response']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Responses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Response'), array('action' => 'add')); ?> </li>
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
	<div class="span10">
		<h2><?php  echo __('Response');?></h2>
		<dl>
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($response['Response']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Participant'); ?></dt>
		<dd>
			<?php echo $this->Html->link($response['Participant']['id'], array('controller' => 'participants', 'action' => 'view', $response['Participant']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stimulus'); ?></dt>
		<dd>
			<?php echo $this->Html->link($response['Stimulus']['name'], array('controller' => 'stimuli', 'action' => 'view', $response['Stimulus']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Experiment'); ?></dt>
		<dd>
			<?php echo $this->Html->link($response['Experiment']['name'], array('controller' => 'experiments', 'action' => 'view', $response['Experiment']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stimulus Condition'); ?></dt>
		<dd>
			<?php echo $this->Html->link($response['StimulusCondition']['name'], array('controller' => 'stimulus_conditions', 'action' => 'view', $response['StimulusCondition']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Time'); ?></dt>
		<dd>
			<?php echo h($response['Response']['start_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Time'); ?></dt>
		<dd>
			<?php echo h($response['Response']['end_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Misc Note'); ?></dt>
		<dd>
			<?php echo h($response['Response']['misc_note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Response Value'); ?></dt>
		<dd>
			<?php echo h($response['Response']['response_value']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
