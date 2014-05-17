<?php     
echo $this->Html->script('jquery-1.9.0'); 
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('test');
echo $this->Html->script('jquery-ui-1.10.1.custom');
echo $this->Html->css('jquery-ui-1.10.1.custom');
?>
<script>

</script>
	<div class="pull-left row-fluid">
    	<div class="span3">
			Project:<strong><?php echo $this->Session->read('Project.name'); ?></strong>
		</div>
		<div class="span6">
			Description:<strong><?php echo $this->Session->read('Project.description'); ?></strong>
		</div>
	</div>
	<div class="pull-left row-fluid">
		 <div class="span3">
			Experiment:<strong><?php echo $this->Session->read('Experiment.name'); ?></strong>
		</div>
		<div class="span6">
			Description:<strong><?php echo $this->Session->read('Experiment.description'); ?></strong>
		</div>
	</div>
<h4>View Experiment</h4>
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
		echo $this->Form->input('name', array('disabled' => true));
		echo $this->Form->input('description', array('disabled' => true));
		echo $this->Form->input('start_time', array('disabled' => true, 'type' => 'text'));
		echo $this->Form->input('end_time', array('disabled' => true, 'type' => 'text'));
	?>
</fieldset>
<?php echo $this->Form->end();?>

<h4>Privilege List</h4>
<table class="table table-striped bootstrap-datatable">
	<tr>
		<th>User Name</th>
		<th>Role</th>
		<th>Start Time</th>
		<th>End Time</th>
	</tr>
		<?php foreach ($privileges as $privilege): ?>
		<tr>
			<td><?php echo $privilege['User']['first_name'];?></td>
			<td><?php echo $privilege['Role']['name'];?></td>
			<td><?php echo $privilege['Privilege']['start_time'];?></td>
			<td><?php echo $privilege['Privilege']['end_time'];?></td>
		</tr>
	<?php endforeach; ?>
</table>


<?php 
	$user = $this->Session->read('Auth.User');
	if($user['role_id'] == 2):
?>
<div class="row_fluid">
<div class="input-prepend input-append">
    <form action="/uds/privileges/grantOrRevoke" method="post" onsubmit="return confirm('Are you sure you want to approve?');">
	<?php echo $this->Form->create('Privilege');?>
		<select id="role_id" class="input-small" name="data[operation]">
			<option value="0" selected></option>
			<option value="1">Grant</option>
			<option value="2">Revoke</option>
		</select>
   		<?php echo $this->Form->input('user_id', array('label' => false, 'div' => false, 'class' => 'input-small')); ?> 		
    	<span class="add-on">right as</span>
		<?php 
		    echo $this->Form->input('role_id', array('label' => false, 'div' => false, 'class' => 'input-small')); 
			echo $this->Form->input('start_time', array('label' => false, 'type' => 'text', 'div' => false, 'class' => 'input-small', 'placeholder' => 'Start Date'));
			echo $this->Form->input('end_time', array('label' => false, 'type' => 'text', 'div' => false, 'class' => 'input-small', 'placeholder' => 'End Date'));
		?>
    <?php echo $this->Form->end();?>
</div>

</div>
<?php endif; ?>			
<div class="pull-left">
  <a class="btn btn-primary" type="button" href="/uds/experiments/index">Go Back</a>
</div>