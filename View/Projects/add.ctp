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
<h4>Add/Edit Project</h4>(Fields marked * are required.)
<?php echo $this->Form->create('Project', array(
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
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo "<label class='control-label required'>Sponsor Grant</label>";
		echo $this->Form->input('grant', array('label' => false));
		echo $this->Form->input('start_time', array('type' => 'text'));
		echo $this->Form->input('end_time', array('type' => 'text'));
	?>
</fieldset>  
<?php echo $this->Form->end();?>
<div class="pull-left">
   <a class="btn btn-primary" type="button" href="/uds/projects/index">Go Back</a>
</div>
<div class="offset5">
    <a class="btn btn-primary" type="button" onclick="document.forms[0].submit();return false;">Save</a>
</div>