<?php echo $this->Form->create('Role', array('class' => 'form-horizontal'));?>
	<fieldset>
		<legend><?php echo __('Edit Role'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
	<br/>
	<?php echo $this->Form->submit('Save',array('class'=>'btn btn-primary','div'=>false));?>
<?php echo $this->Form->end();?>