<script>
$(function() {
    $("#start_time" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $("#end_time" ).datepicker({ dateFormat: 'yy-mm-dd' });	
    $("#ProjectStartTime" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $("#ProjectEndTime" ).datepicker({ dateFormat: 'yy-mm-dd' });       
});
</script>

<h4><?php echo __('Edit Project');?></h4> (Fields marked * are required.)
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
		echo $this->Form->input('name',array('required'=>'required'));
		echo $this->Form->input('description');
		echo $this->Form->input('grant_id');
		echo $this->Form->input('start_time', array('type' => 'text'));
		echo $this->Form->input('end_time', array('type' => 'text'));
		echo "<label class='control-label required'><?php echo __('PI');?></label>";
		echo $this->Form->input('user_id', array('label' => false));
	?>
</fieldset>  
<?php echo $this->Form->end();?>
<div class="offset4">
    <a class="btn btn-primary" type="button" onclick="document.forms[0].submit();return false;">Save</a>
</div>