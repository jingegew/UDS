<div class="span10">
	<h2>Survey</h2>
	<div class="row-fluid">
		<div class="pull-left">
			<h4><?php echo $introduction; ?></h4>
		</div>
	</div>
	<div class="row-fluid">
		<div id="age_column" class="span6"></div>
		<div id="visualization" class="span6"></div>
	</div>
	<div class="row-fluid">
		<div id="chart_div" class="span9"></div>
	</div>
	<table class="table table-striped bootstrap-datatable" style="white-space:nowrap;">
	<tr>
		<th>Comments</th>
	</tr>
	<br/>
	<br/>
	<?php foreach($comments as $comment): ?>
	<tr>
		<td>
		<div class="span5">
			<textarea type="text" class="input-xxlarge" disabled><?php echo $comment; ?></textarea>
		</div>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
</fieldset>
<script src="/uds/js/jquery-1.9.0.js"></script>
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
    var options = {'title':'By Responses',
                   vAxis: {title: "Number of Responses"},
                   hAxis: {title: "Question"},     
    			   seriesType: "bars",
    			   'width':600, 
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
$(document).ready(function() {
   	 $.ajax({
            type: 'POST',
            url: '<?php echo $this->Html->url(array("controller" => "questions","action" => "visualizeData"));?>',
            success:function(data){
            	if(data.length > 0){
            		console.log(data);
            		data = $.parseJSON(data);
            		google.setOnLoadCallback(drawData(data.race));
            		google.setOnLoadCallback(drawChart(data.survey)); 
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