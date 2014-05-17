<script>
$(function() {
  	$("#start_time" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $("#end_time" ).datepicker({ dateFormat: 'yy-mm-dd' }); 
    $("#ExperimentStartTime" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $("#ExperimentEndTime" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $("#PrivilegeStartTime" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $("#PrivilegeEndTime" ).datepicker({ dateFormat: 'yy-mm-dd' });
    
    $('#rangeText').text($('#rangeInput').val()+'%');
    $('#rangeInput').on('change', function () {
        $('#rangeText').text($(this).val()+'%');
    });
});

$(document).ready(function() {
    $.ajax({ 
        type: "GET", 
        url: "/uds/users/getUsers", 
        success:function(response){ 
        	var data = $.parseJSON(response);
            $("#userList").typeahead({source: data});
        }, 
     	error: function(xhr, textStatus, errorThrown) { 
        	
        } 
    }); 

    $("#saveButton").click(function() {
        $.post($("#ExperimentEditForm").attr("action"), $("#ExperimentEditForm").serialize(),
          function() {
            $.post($("#PrivilegeGrantOrRevokeForm").attr("action"), $("#PrivilegeGrantOrRevokeForm").serialize(),
              function() {
              	top.location.href = '/uds/experiments/index';
              });
          });
      });
  });
</script>
<h4><?php echo __('Edit Experiment'); ?></h4>
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


<div>
<h4>Privilege List</h4>
<a href="#myModal" class="btn" data-toggle="modal"><?php echo __('New'); ?></a>
</div>
<br/>
<table class="table table-striped bootstrap-datatable">
	<tr>
		<th>User</th>
		<th>Role</th>
		<th>Start Time</th>
		<th>End Time</th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
		<?php foreach ($privileges as $privilege): ?>
		<tr>
			<td><?php echo $privilege['User']['email'];?></td>
			<td><?php echo $privilege['Role']['name'];?></td>
			<td><?php echo $privilege['Privilege']['start_time'];?></td>
			<td><?php echo $privilege['Privilege']['end_time'];?></td>
			<td class="actions">
			<div class="btn-toolbar">
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'privileges', 'action' => 'edit', $privilege['Privilege']['id']), array('class' => 'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'privileges', 'action' => 'delete', $privilege['Privilege']['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $privilege['Privilege']['id'])); ?>
			</div>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
<!--
<div class="row_fluid">
<span class="label label-info">Nonregister users being granted access will need to register in order to be granted privilege.</span>
</div>
<br/>
<?php 
	$user = $this->Session->read('Auth.User');
	if($user['role_id'] == 2):
?>
<div class="row_fluid">
<div class="input-prepend input-append">
	<?php echo $this->Form->create('Privilege', array('action' => 'grantOrRevoke'));?>
		<select id="role_id" class="input-small" name="data[operation]">
			<option value="0" selected>-Select-</option>
			<option value="1">Grant</option>
			<option value="2">Revoke</option>
		</select>
   		<input id="userList" name="data[email]" class="span3" type="text" data-items="4" data-provide="typeahead" style="margin: 0 auto;"> 		
    	<span class="add-on">rights as</span>
		<?php 
		    echo $this->Form->input('role_id', array('label' => false, 'div' => false, 'class' => 'input-small')); 
			echo $this->Form->input('start_time', array('label' => false, 'type' => 'text', 'div' => false, 'class' => 'input-small', 'placeholder' => date("Y-m-d")));
			echo $this->Form->input('end_time', array('label' => false, 'type' => 'text', 'div' => false, 'class' => 'input-small', 'placeholder' => '2015-12-31'));
		?>

    <?php echo $this->Form->end();?>
</div>
</div>
-->
<?php endif; ?>		
<div class="pull-left">
  <a id="saveButton" class="btn btn-primary" type="button"><?php echo __('Save'); ?></a>
  <!-- a class="btn btn-primary" type="button" href="/uds/experiments/index">Go Back</a -->
</div>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Assign Privilege</h3>
  </div>
  <?php echo $this->Form->create('Privilege', array('action' => 'grant',
    'class' => 'form-horizontal',
    'inputDefaults' => array(    
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => 'required control-label'),
        'between' => '<div class="controls">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));?>
  <div class="modal-body">
	<fieldset>
	<?php
		echo $this->Form->input('invite', array('id' => 'userList', 'type'=>'text','data-items'=>'4','data-provide'=>'typeahead'));		
		echo $this->Form->input('role_id');
		echo '<div class="control-group">
<label for="rangeInput" class="required control-label">Data Limit</label>
<div class="controls">
<input name="data[Privilege][data_limit]" id="rangeInput" class="add-label" min="0" max="100" step="1" type="range"><label id="rangeText">17%</label></div>
</div>';
		echo $this->Form->input('start_time', array('type' => 'text', 'class' => 'input-small datepicker', 'placeholder' => date("Y-m-d")));
		echo $this->Form->input('end_time', array('type' => 'text', 'class' => 'input-small datepicker', 'placeholder' => "2015-12-31"));
	?>
	<label id="rangeText">
	</fieldset>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Close'); ?></button>
    <button type="submit" class="btn btn-primary"><?php echo __('Add'); ?></button>
  </div>
  </form>
</div>