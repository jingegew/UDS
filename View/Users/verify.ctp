<?php echo $this->Form->create('User', array(
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => 'control-label'),
        'between' => '<div class="controls">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));?>
	<fieldset>
		<legend><?php echo 'Security Questions'; ?></legend>
	<?php
		echo $this->Form->input('security_question_1', array('class' => 'input-small'));
		echo $this->Form->input('answer1', array('class' => 'input-small'));
		echo $this->Form->input('security_question_2', array('class' => 'input-small'));
		echo $this->Form->input('answer2', array('class' => 'input-small'));
	?>
	<div class="form-actions">
		<?php echo $this->Form->submit('Save',array('class'=>'btn btn-primary','div'=>false));?>
		<?php echo $this->Html->link('Go Back',array('controller' => 'users', 'action' => 'login'),array('class'=>'btn btn-cancel'));?>
	</div>
	</fieldset>
<?php echo $this->Form->end();?>