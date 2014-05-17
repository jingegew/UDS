<?php
$user = $this->Session->read('Auth.User');    
echo $this->Html->script('jquery-1.9.0');
echo $this->Html->script('jquery-ui-1.10.1.custom');
echo $this->Html->css('jquery-ui-1.10.1.custom');
?>

<script>
  $(function() {
    $("#start_time" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $("#end_time" ).datepicker({ dateFormat: 'yy-mm-dd' });
    
    $("#editExperiment").tooltip();
    $("#viewData").tooltip();
    $("#uploadData").tooltip();
    $("#viewExperiment").tooltip();
        
    $('input[type="radio"]').change(function(){
   		$("#editExperiment").removeAttr("disabled");
   		$("#editExperiment").addClass("btn-primary");
		$("#editExperiment").attr("href", "/uds/experiments/edit/" + $(this).val());
	
		$("#viewExperiment").removeAttr("disabled");
		$("#viewExperiment").addClass("btn-primary");
		$("#viewExperiment").attr("href", "/uds/experiments/view/" + $(this).val());
	
		$("#viewData").removeAttr("disabled");
		$("#viewData").addClass("btn-primary");
		$("#viewData").attr("href", "/uds/responses/index/" + $(this).val());
	
		$("#uploadData").removeAttr("disabled");
		$("#uploadData").addClass("btn-primary");
		$("#uploadData").attr("href", "/uds/uploads/index/" + $(this).val());	
		
		$.ajax({
          	type: 'POST',
        	data: {"id": $(this).val()},
            url: '/uds/experiments/select',
            success:function(data){
            },
            error:function(){
            }
        });    
	});
  });

</script>

<?php 
$project = $this->Session->read('Project.name');
if(!isset($project)):?>
<div class="row-fluid">
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><?php echo __('No Project Selected!');?></h4>
  <?php echo __('Please select a project which you would like working on by clicking Projects menu on the left.');?>  
</div>
</div>
<?php else: ?>
<div class="row-fluid">
	<div class="pull-left span3">
	<h4><?php echo __('My Experiments'); ?></h4>
	</div>
	<div class="span3 offset6">
		<?php if($user['role_id'] == 2): ?>
		<a href="#myModal" class="btn btn-primary" data-toggle="modal"><?php echo __('New');?></a>
		<?php endif; ?>
	</div>
</div>
<table class="table datatable dataTable">	
<thead> 
	<tr>
		<th></th>
		<th><?php echo __('Name');?></th>
		<th><?php echo __('Description');?></th>
		<th><?php echo __('Start Time');?></th>
		<th><?php echo __('End Time');?></th>
	</tr>
</thead> 
<tbody> 
<?php
	foreach ($experiments as $experiment): ?>
	<tr>
		<td><input type = "radio" name = "experimentID" id = "experimentID" value = "<?php echo $experiment['Experiment']['id']; ?>" <?php echo ($this->Session->read('Experiment.id') == $experiment['Experiment']['id']) ? 'checked = true' : '';?>/></td>
		<td><?php echo h($experiment['Experiment']['name']); ?>&nbsp;</td>
		<td><?php echo h($experiment['Experiment']['description']); ?>&nbsp;</td>
		<td><?php echo h($experiment['Experiment']['start_time']); ?>&nbsp;</td>
		<td><?php echo h($experiment['Experiment']['end_time']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
<br/>

<p>
  <?php $user = $this->Session->read('Auth.User'); 
  		$eid = $this->Session->read('Experiment.id');
  		if($user['role_id'] == 2): ?> 
  	<a id="editExperiment" data-placement="top" data-original-title="Select an experiment." <?php echo $eid == null ? 'class="btn"' : 'class="btn btn-primary"';?> type="button" <?php echo $eid == null ? 'disabled' : 'href="/uds/experiments/edit/' . $eid . '"';?>><?php echo __('Edit');?></a>
  &nbsp;
  &nbsp;
  <?php endif; ?>
  <?php if($user['role_id'] > 1): ?> 
  	<a id="viewData" data-placement="top" data-original-title="Select an experiment." <?php echo $eid == null ? 'class="btn"' : 'class="btn btn-primary"';?> type="button" <?php echo $eid == null ? 'disabled' : 'href="/uds/responses/index/' . $eid . '"';?>><?php echo __('View Data');?></a>
  &nbsp;
  &nbsp;
  <?php endif; ?>
  <?php if($user['role_id'] == 2 || $user['role_id'] == 3): ?> 
  	<a id="uploadData" data-placement="top" data-original-title="Select an experiment." <?php echo $eid == null ? 'class="btn"' : 'class="btn btn-primary"';?> type="button" <?php echo $eid == null ? 'disabled' : 'href="/uds/uploads/index"';?>><?php echo __('Upload Data');?></a>
  <?php endif; ?>
</p>

<?php endif; ?>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h3 id="myModalLabel"><?php echo __('Add Experiment');?></h3>
  </div>
  <form accept-charset="utf-8" method="post" id="ExperimentIndexForm" action="/uds/experiments/add">
  <div class="modal-body">
	<fieldset>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
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