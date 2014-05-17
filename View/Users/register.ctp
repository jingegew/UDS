<script>
submitForms = function(){
	if(document.getElementById('agreement').checked){
		document.forms[0].submit();
		return false;
	} else {
		alert("Please accept the Terms and Conditions to continue.");
		return false; 
	}
}
</script>
<h4>Welcome to UDS!</h4>
<?php echo $this->Form->create('User', array(
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => 'required control-label'),
        'between' => '<div class="controls">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));?>
	<fieldset>
		<legend>Registration</legend>
		<p>You registration request below requires approval to become operational (processing requests takes at least 24 hours.)</p>
		<input id="agreement" type = "checkbox"/>&nbsp;&nbsp;<span>I accept the <a href="">Terms and Conditions</a> required to access
		and use this repository. <br> I understand that violation of these conditions may lead to suspension and/or termination of access privileges.<br>
		(Security questions will be required as the only way to recover/change your password. Items marked * are required for registration.) <br/></span>
	<br/>
	<?php
		echo "<label class='control-label required'>Email/Username</label>";
		echo $this->Form->input('email', array('label' => false, 'class' => 'input-medium'));
		echo $this->Form->input('password', array('class' => 'input-small'));
		echo $this->Form->input('first_name', array('class' => 'required input-small'));
		echo $this->Form->input('last_name', array('class' => 'required input-small'));
		echo $this->Form->input('role_id', array('class' => 'input-medium'));
	?>
	</fieldset>
<?php echo $this->Form->end();?>
<div class="pull-left">
<?php echo $this->Html->link('Go Back',array('controller' => 'users', 'action' => 'login'),array('class'=>'btn btn-primary'));?>
</div>
<div class="offset5">
<a class="btn btn-primary" type="button" onclick="submitForms()">Save</a>
</div>