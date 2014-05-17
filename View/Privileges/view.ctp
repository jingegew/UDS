<div class="accesses view row">
	<div class="actions span2">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
					<li><?php echo $this->Html->link(__('Edit Privilege'), array('action' => 'edit', $privilege['Privilege']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Privilege'), array('action' => 'delete', $privilege['Privilege']['id']), null, __('Are you sure you want to delete # %s?', $privilege['Privilege']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Privileges'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Privilege'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Experiments'), array('controller' => 'experiments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Experiment'), array('controller' => 'experiments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<div class="span10">
		<h2><?php  echo __('Privilege');?></h2>
		<dl>
					<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($privilege['Privilege']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($privilege['User']['name'], array('controller' => 'users', 'action' => 'view', $privilege['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Project'); ?></dt>
		<dd>
			<?php echo $this->Html->link($privilege['Project']['name'], array('controller' => 'projects', 'action' => 'view', $privilege['Project']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Experiment'); ?></dt>
		<dd>
			<?php echo $this->Html->link($privilege['Experiment']['name'], array('controller' => 'experiments', 'action' => 'view', $privilege['Experiment']['id'])); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
</div>
