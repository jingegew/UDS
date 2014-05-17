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
		echo $this->Form->input('password', array('class' => 'input-small'));
		echo $this->Form->input('first_name', array('class' => 'required input-small'));
		echo $this->Form->input('last_name', array('class' => 'required input-small'));
		echo $this->Form->input('role_id', array('class' => 'input-medium'));
		echo "<label class='control-label required'>Security Question 1</label>";
		echo $this->Form->input('question1', array('label' => false, 'class' => 'input-xxlarge', 'type' => 'select', 'options' => 
				array('What was your childhood nickname?'=>'What was your childhood nickname?',
					  'In what city did you meet your spouse/significant other?'=>'In what city did you meet your spouse/significant other?',
					  'What is the name of your best childhood friend?'=>'What is the name of your best childhood friend?',
					  "What is your mother's maiden name?"=>"What is your mother's maiden name?")));
		echo $this->Form->input('answer1', array('class' => 'input-large'));
		echo "<label class='control-label required'>Security Question 2</label>";
		echo $this->Form->input('question2', array('label' => false, 'class' => 'input-xxlarge', 'type' => 'select', 'options' => 
				array('What was your childhood nickname?'=>'What was your childhood nickname?',
					  'In what city did you meet your spouse/significant other?'=>'In what city did you meet your spouse/significant other?',
					  'What is the name of your best childhood friend?'=>'What is the name of your best childhood friend?',
					  "What is your mother's maiden name?"=>"What is your mother's maiden name?")));
		echo $this->Form->input('answer2', array('class' => 'input-large'));
	?>
	</fieldset>
<?php echo $this->Form->end();?>
<div class="row-fluid">
	<a class="btn btn-primary" type="button" onclick="document.forms[0].submit();return false;">Save</a>
	<?php echo $this->Html->link('Go Back',array('controller' => 'projects', 'action' => 'index'),array('class'=>'btn btn-primary'));?>
</div>