<?php 
$experiment = $this->Session->read('Experiment.name');
if(!isset($experiment)):?>
<div class="row-fluid">
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><?php echo __('No Experiment Selected!');?></h4>
  <?php echo __('Please select an experiment which you would like working on by clicking Experiments menu on the left.');?>
</div>
</div>
<?php else: ?>
<div class="row-fluid">
	<div class="span9">
		<?php echo __('Summary');?>: <strong><?php echo __('Participants');?>: <?php echo $totalParticipant; ?></strong>&nbsp;&nbsp;
		<strong><?php echo __('Stimuli');?>: <?php echo $totalStimulus; ?></strong>&nbsp;&nbsp;
		<strong><?php echo __('Responses');?>: <?php echo $totalResponse; ?></strong>&nbsp;&nbsp;
	</div>
</div>

<?php if(isset($responses) && count($responses) > 0): ?>
<div>
<form class="form-search" method="post" action="/uds/responses/index">
<input id="query" name="data[query]" type="text" class="input-medium search-query" value="<?php echo $query; ?>">
<button type="submit" class="btn"><?php echo __('Search');?></button>
</form>

<table class="table datatable dataTable table-hover">
	<thead> 
	<tr>
		<th>ID</th>
		<th><span class="popover-test" data-content="<?php echo $header['Participant']['description']; ?>" data-original-title="Participant ID"><?php echo isset($header['Participant']['id'])? $header['Participant']['id'] : 'Participant'; ?></span></th>
		<th><span class="popover-test" data-content="<?php echo $header['Stimulus']['description']; ?>" data-original-title="Stimulus Name"><?php echo isset($header['Stimulus']['name'])? $header['Stimulus']['name'] : 'Stimulus'; ?></span></th>
		<th><span class="popover-test" data-content="<?php echo $header['Response']['description']; ?>" data-original-title="Response Value"><?php echo isset($header['Response']['value_name'])? $header['Response']['value_name'] : 'Response Value'; ?></span></th>
		<?php 
			foreach ($attributes as $attribute) {
				echo '<th><span class="popover-test" data-content="' . $attribute['description'] . '" data-original-title="Response">' . $this->Paginator->sort($attribute['name']) . '</span></th>';
			}
		?>
		<th><?php echo $this->Paginator->sort('date_entered');?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
		</thead> 
	<tbody> 
	<?php foreach ($responses as $response): ?>
	<tr>
		<td><?php echo $response['Response']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($response['Participant']['uid'], array('controller' => 'participants', 'action' => 'view', $response['Participant']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($response['Stimulus']['name'], array('controller' => 'stimuli', 'action' => 'view', $response['Stimulus']['id'])); ?>
		</td>	
		<td><?php echo $response['Response']['response_value']; ?>&nbsp;</td>
		<?php 
			foreach ($attributes as $attribute) {
				echo "<td>" . $response['Response'][$attribute['name']] . "</td>";
			}
		?>
		<td><?php echo $response['Response']['date_entered']; ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $response['Response']['id']), array('class' => 'btn btn-mini')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $response['Response']['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $response['Response']['id'])); ?>
				</div>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
<div class="row_fluid">
<div class="pull-left">
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	
</div>

<div class="paging btn-group pull-right">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array('class' => 'prev btn'), null, array('class' => 'prev disabled btn'));
		echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn', 'currentClass' => 'active'));
		echo $this->Paginator->next(__('next') . ' >', array('class' => 'next btn'), null, array('class' => 'next disabled btn'));
	?>
</div>
</div>
<br/>
<br/>
<div class="row_fluid">
<div class="pull-left">
<a class="btn btn-primary" type="button" href="/uds/uploads/download"><?php echo __('Export');?></a>
<a id="visualizeData" type="button" class="btn btn-primary"><?php echo __('Visualize Data');?></a>
</div>
<div class="row-fluid">
	<div id="age_column" class="span6">
	</div>
	<div id="visualization" class="span6">
	</div>
</div>
<div class="row-fluid">
	<div id="chart_div" class="span12">
	</div>
</div>

</div>
<?php endif; ?>
<?php if(isset($responses) && count($responses) == 0 ): ?>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><?php echo __('No Data Found!');?></h4>
  <?php echo __('There are no data associate with this experiment.');?>
</div>
<?php endif; ?>
</div>

<div id="noDataFound" class="alert alert-info" style="display:none">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><?php echo __('No Data Found!');?></h4>
  <?php echo __('There are no data associate with this experiment.');?>
</div>
<?php endif; ?>
<script src="http://www.google.com/jsapi"></script>
<script>
function drawData(response){
	var data = new google.visualization.DataTable(response);
	var ac = new google.visualization.PieChart(document.getElementById('visualization'));
	var options = {'title':'By Race', 'width':400, 'height':300};
	ac.draw(data, options);            
}

function drawChart(response) {
    var data = new google.visualization.DataTable(response);
    var options = {'title':'Responses by stimuli',
                   vAxis: {title: "Number of responses"},
                   hAxis: {title: "Stimuli"},     
    			   seriesType: "bars",
    			   'width':1500, 
    			   'height':300};      
    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}

function drawAgeColumnChart(response) {
    var data = new google.visualization.DataTable(response);
    var options = {'title':'By Age',
                   vAxis: {title: "Number"},
                   hAxis: {title: "Age (Years)"},     
    			   seriesType: "bars",
    			   'width':600, 
    			   'height':300};      
    var chart = new google.visualization.ColumnChart(document.getElementById('age_column'));
    chart.draw(data, options);
}
google.load('visualization', '1', {packages: ['corechart']});
$("#visualizeData").click(function() {
   	 $.ajax({
            type: 'POST',
            url: '<?php echo $this->Html->url(array("controller" => "responses","action" => "visualizeData"));?>',
            success:function(data){
            	if(data.length > 0){
            		console.log(data);
            		data = $.parseJSON(data);
            		google.setOnLoadCallback(drawData(data.race));
            		google.setOnLoadCallback(drawChart(data.Response)); 
            		google.setOnLoadCallback(drawAgeColumnChart(data.age));
            	} else {
            		$('#noDataFound').show();
            	} 
            },
            error:function(){
            	$('#noDataFound').show();
            }
        });
}); 
</script>