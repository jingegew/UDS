<div class="pull-left row-fluid">
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
		<legend><?php echo 'Change Profile for ' . $this->data['User']['email']; ?></legend>
	<?php
		echo "<label class='control-label required'>Email/Username</label>";
		echo $this->Form->input('email', array('label' => false, 'class' => 'input-medium'));
		echo $this->Form->input('new_password', array('class' => 'input-small','type' => 'password'));
		echo $this->Form->input('first_name', array('class' => 'required input-small'));
		echo $this->Form->input('last_name', array('class' => 'required input-small'));
		echo $this->Form->input('role_id', array('class' => 'input-medium'));
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>
<div class="row-fluid">
	<a class="btn btn-primary" type="button" onclick="document.forms[0].submit();return false;">Save</a>
</div>
