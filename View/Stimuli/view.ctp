
		<h2><?php  echo __('Stimulus');?></h2>
		<dl>
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($stimulus['Stimulus']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($stimulus['Stimulus']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($stimulus['Stimulus']['description']); ?>
			&nbsp;
		</dd>
		</dl>

			<hr>
			<h3><?php echo __('Related Responses');?></h3>
			<div class="btn-toolbar">
			<?php echo $this->Html->link(__('New Response'), array('controller' => 'responses', 'action' => 'add'), array('class'=>'btn btn-mini'));?>			</div>
	<?php if (!empty($stimulus['Response'])):?>
			<table class="table table-striped table-bordered bootstrap-datatable">
				<tr>
							<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Participant Id'); ?></th>
		<th><?php echo __('Stimulus Id'); ?></th>
		<th><?php echo __('Experiment Id'); ?></th>
		<th><?php echo __('Response Value'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
					<?php
		$i = 0;
		foreach ($stimulus['Response'] as $response): ?>
		<tr>
			<td><?php echo $response['id'];?></td>
			<td><?php echo $response['participant_id'];?></td>
			<td><?php echo $response['stimulus_id'];?></td>
			<td><?php echo $response['experiment_id'];?></td>
			<td><?php echo $response['response_value'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
				<?php echo $this->Html->link(__('View'), array('controller' => 'responses', 'action' => 'view', $response['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'responses', 'action' => 'edit', $response['id']), array('class' => 'btn btn-mini')); ?>
				</div>
				<div class="btn-group">
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'responses', 'action' => 'delete', $response['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $response['id'])); ?>
				</div>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
			</table>
	<?php endif; ?>
