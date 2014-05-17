<?php     
echo $this->Html->script('jquery-1.9.0');
echo $this->Html->script('jquery-ui-1.10.1.custom');
echo $this->Html->css('jquery-ui-1.10.1.custom');
?>
<script>
$(function() {
  	$("#start_time").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#end_time").datepicker({ dateFormat: 'yy-mm-dd' }); 
    $("#ExperimentStartTime").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#ExperimentEndTime").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#PrivilegeStartTime").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#PrivilegeEndTime").datepicker({ dateFormat: 'yy-mm-dd' });        
});
submitForms = function(){
	document.forms[0].submit();
	document.forms[1].submit();
	return false;
}
</script>
<h4>Add/Edit Experiment</h4>(Fields marked * are required.)
<?php echo $this->Form->create('Experiment', array(
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
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('start_time', array('type' => 'text'));
		echo $this->Form->input('end_time', array('type' => 'text'));
	?>
</fieldset>
<?php echo $this->Form->end();?>

<?php 
	$user = $this->Session->read('Auth.User');
	if($user['role_id'] == 2):
?>
<div class="row_fluid">

<div class="pull-left">
  <a class="btn btn-primary" type="button" href="/uds/experiments/index">Go Back</a>
</div>
<div class="offset5">
  <a class="btn btn-primary" type="button" onclick="submitForms()">Save</a>
</div>

</div>
<?php endif; ?>