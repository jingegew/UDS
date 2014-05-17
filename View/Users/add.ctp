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
		<legend><?php echo 'Registration'; ?></legend>
	<?php
		echo $this->Form->input('name', array('class' => 'input-small'));
		echo $this->Form->input('last_name', array('class' => 'input-small'));
		echo $this->Form->input('first_name', array('class' => 'input-small'));
		echo $this->Form->input('role_id', array('class' => 'input-medium'));
		echo $this->Form->input('email', array('class' => 'input-medium'));
		echo $this->Form->input('username', array('class' => 'input-small'));
		echo $this->Form->input('password', array('class' => 'input-small'));
		echo $this->Form->input('description', array('rows'=> '2', 'class' => 'input-xlarge'));
	?>
	<div class="form-actions">
		<?php echo $this->Form->submit('Save',array('class'=>'btn btn-primary','div'=>false));?>
		<?php echo $this->Html->link('Cancel',array('controller' => 'projects', 'action' => 'index'),array('class'=>'btn btn-cancel'));?>
	</div>
	</fieldset>
<?php echo $this->Form->end();?>