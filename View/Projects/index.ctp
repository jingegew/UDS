<?php     
echo $this->Html->script('jquery-1.9.0');
echo $this->Html->script('jquery-ui-1.10.1.custom');
echo $this->Html->css('jquery-ui-1.10.1.custom');
?>

<script>
$(function() {
  	$("#start_time" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $("#end_time" ).datepicker({ dateFormat: 'yy-mm-dd' });
    
    $("#editProject").tooltip();
    $("#viewProject").tooltip();
    $("#viewExperiment").tooltip();
    
    $('input[type="radio"]').change(function(){
    	$("#editProject").removeAttr("disabled");
    	$("#editProject").addClass("btn-primary");
	    $("#editProject").attr("href", "/uds/projects/edit/" + $(this).val());
	    
	    $("#viewProject").removeAttr("disabled");
	    $("#viewProject").addClass("btn-primary");
	    $("#viewProject").attr("href", "/uds/projects/view/" + $(this).val());
	    
	    $("#viewExperiment").removeAttr("disabled");
	    $("#viewExperiment").addClass("btn-primary");
	    $("#viewExperiment").attr("href", "/uds/experiments/index/" + $(this).val());
	    console.log("Project ID: " + $(this).val());
   		$.ajax({
          	type: 'POST',
        	data: {"id": $(this).val()},
            url: '/uds/projects/select',
            success:function(data){
            },
            error:function(){
            }
        });
	});
});
</script>

<div class="row-fluid">
<div class="span3">
<h4><?php echo $title_for_layout; ?></h4>
</div>
<div class="span3 offset6">
  <?php $user = $this->Session->read('Auth.User'); if($user['role_id'] == 2): ?>
	<a href="#myModal" class="btn btn-primary" data-toggle="modal"><?php echo __('New');?></a>
  <?php endif; ?>
</div>
</div>

<div>
<table class="table table-striped bootstrap-datatable datatable dataTable">	
<thead> 
	<tr>
			<th></th>
			<th><?php echo __('Name');?></th>
			<th><?php echo __('Description');?></th>
			<th><?php echo __('Grant');?></th>
			<th><?php echo __('Start Time');?></th>
			<th><?php echo __('End Time');?></th>
			<th><?php echo __('PI');?></th>
	</tr>
	</thead> 
	<tbody> 
	<?php
	foreach ($projects as $project): ?>
	<tr>
		<td><input type = "radio" name = "projectID" id = "projectID" value = "<?php echo $project['Project']['id']; ?>" <?php echo ($this->Session->read('Project.id') == $project['Project']['id']) ? 'checked = true' : '';?>/></td>
		<td><?php echo h($project['Project']['name']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['description']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($project['Grant']['name'], array('controller' => 'grants', 'action' => 'view', $project['Grant']['id'])); ?>
		</td>
		<td><?php echo h($project['Project']['start_time']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['end_time']); ?>&nbsp;</td>
		<td>
			<?php echo $project['User']['first_name'] . " " . $project['User']['last_name']; ?>&nbsp;
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<br/>

<p>
  <?php $user = $this->Session->read('Auth.User'); 
  		$pid = $this->Session->read('Project.id');
  	if($user['role_id'] == 2): ?> 
  <a id="editProject" data-placement="top" data-original-title="Select a project." <?php echo $pid == null ? 'class="btn"' : 'class="btn btn-primary"';?> type="button" <?php echo $pid == null ? 'disabled' : 'href="/uds/projects/edit/' . $pid . '"';?>><?php echo __('Edit');?></a>
  &nbsp;
  &nbsp;
  <?php endif; ?>
  <?php if($user['role_id'] > 2): ?> 
  <a id="viewProject" data-placement="top" data-original-title="Select a project." <?php echo $pid == null ? 'class="btn"' : 'class="btn btn-primary"';?> type="button" <?php echo $pid == null ? 'disabled' : 'href="/uds/projects/view/' . $pid . '"';?>><?php echo __('View');?></a>
  &nbsp;
  &nbsp;
  <?php endif; ?>
  <?php if($user['role_id'] > 1): ?> 
  <a id="viewExperiment" data-placement="top" data-original-title="Select a project." <?php echo $pid == null ? 'class="btn"' : 'class="btn btn-primary"';?> type="button" <?php echo $pid == null ? 'disabled' : 'href="/uds/experiments/index/' . $pid . '"';?>><?php echo __('View Experiments');?></a>
  <?php endif; ?>
</p>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel"><?php echo __('Add Project');?></h3>
  </div>
  <form accept-charset="utf-8" method="post" id="ProjectIndexForm" action="/uds/projects/add">
  <div class="modal-body">
	<fieldset>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('grant_id');
		echo $this->Form->input('start_time');
		echo $this->Form->input('end_time');
	?>
	</fieldset>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Close');?></button>
    <button type="submit" class="btn btn-primary"><?php echo __('Add');?></button>
  </div>
  </form>
</div>