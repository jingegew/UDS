<div class="pull-left row-fluid">
<?php echo $this->Form->create('Attribute', array('class' => 'form-horizontal'));?>
	<fieldset>
		<legend><?php echo __('Edit Attribute'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('type');
		echo $this->Form->input('display');
		echo $this->Form->input('description');
	?>
	<br/>
<?php echo $this->Form->submit(__('Save'),array('class'=>'btn btn-primary','div'=>false));?>
		</fieldset>
<?php echo $this->Form->end();?>
</div>