<?php     
echo $this->Html->script('jquery-1.9.0'); 
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('test');
echo $this->Html->script('jquery-ui-1.10.1.custom');
echo $this->Html->css('jquery-ui-1.10.1.custom');
?>

<script>
$(function() {
    $("#start_time" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $("#end_time" ).datepicker({ dateFormat: 'yy-mm-dd' });	
    $("#ProjectStartTime" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $("#ProjectEndTime" ).datepicker({ dateFormat: 'yy-mm-dd' });       
});
</script>
	<div class="row-fluid">
    	<div class="pull-left span3">
			Project :<strong><?php echo $this->Session->read('Project.name'); ?></strong>
		</div>
		<div class="span6">
			Description:<strong><?php echo $this->Session->read('Project.description'); ?></strong>
		</div>
	</div>
<h4>View Project</h4>
<?php echo $this->Form->create('Project', array(
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
		echo $this->Form->input('name', array('disabled' => true));
		echo $this->Form->input('description', array('disabled' => true));
		echo $this->Form->input('grant', array('disabled' => true));
		echo $this->Form->input('start_time', array('disabled' => true, 'type' => 'text'));
		echo $this->Form->input('end_time', array('disabled' => true, 'type' => 'text'));
		echo $this->Form->input('user_id', array('disabled' => true));
	?>
</fieldset>  
<?php echo $this->Form->end();?>
<div class="pull-left">
   <a class="btn btn-primary" type="button" href="/uds/projects/index">Go Back</a>
</div>
<div class="offset4">
    <a class="btn btn-primary" type="button" href="/uds/experiments/index">View Experiments</a>
</div>