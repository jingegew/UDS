<div class="answers row">
<div class="actions span2">
	<ul class="nav nav-list">
        <li class="nav-header"><?php echo __('Actions'); ?></li>

		<li><?php echo $this->Html->link(__('List Answers'), array('action' => 'index'));?></li>
	</ul>
</div>
<div class="answers span10">
<?php echo $this->Form->create('Answer', array('class' => 'form-horizontal'));?>
	<fieldset>
		<legend><?php echo __('Add Answer'); ?></legend>
	<?php
		echo $this->Form->input('question_id');
		echo $this->Form->input('answer');
		echo $this->Form->input('user_id');
	?>
		<div class="form-actions">
<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary','div'=>false));?>
<?php echo $this->Html->link(__('Cancel'),array('controller' => '', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
		</div>
		</fieldset>
<?php echo $this->Form->end();?>
</div>
</div>