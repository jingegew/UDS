<script>
$(function() {
$("#version").change(function() {

	$("textarea").each(function( index ) {
		$(this).val("");
	});
	
	var ver = $(this).val();	
	$("#qversion").val(ver);
	
	$.ajax({
  		type: 'POST',
  		url: '/uds/questions/getSurvey',
  		data: {"version": $(this).val()},
  		success: function(response){
			var data = $.parseJSON(response);
			console.log(data);
            $.each(data, function(index, value) {
            	console.log(index + " - " + value);
				 $("#" + index).val(value);
			});
        },
        error:function(){
        }   
	})
});

})
</script>
<div class="span10">
	<h4>Edit Survey Questions</h4>
	<div class="row-fluid">
		<div class="span4">
			Version:<?php echo $this->Form->input('version', array('label' => false, 'div' => false, 'class' => 'input-large')); ?>
		</div>
	<?php echo $this->Form->create('Question', array('class' => 'form-horizontal'));?>
		<div class="span4">
			<label class="checkbox">
				<input type = "checkbox" name = "data[select]" value = "ON"/>Set it as current survey
			</label>			
		</div>
	</div>
	<input id="qversion" name="data[version]" type="hidden" value="999"></input>
	<table class="table table-striped bootstrap-datatable" style="white-space:nowrap;">
	<tr>
		<th></th>
		<th>Statement</th>
		<th>Strongly<br/>Disagree</th>
		<th>Disagree</th>
		<th>Neutral</th>
		<th>Agree</th>
		<th>Strongly<br/>Agree</th>
	</tr>
	<tr><td></td><td><textarea type="text" class="input-xxlarge" id="0" name="data[0][Question][question]"></textarea></td></tr>	
	<?php for ($i = 1; $i <= 12; $i++): ?>
	<tr>
		<td>
		<div class="span1">
			<label><?php echo $i; ?></label>
		</div>
		</td>
		<td>
		<div class="span5">
			<textarea type="text" class="input-xxlarge" id="<?php echo $i; ?>" name="data[<?php echo $i; ?>][Question][question]"></textarea>
		</div>
		</td>
		<?php
			for($j = 1; $j<=5; $j++){
				echo '<td><input type="radio" name="'. $i .'" value="'. $j . '" disabled></td>';
			}
		?>
	</tr>
<?php endfor; ?>
</table>
</fieldset>
<?php echo $this->Form->end();?>
<div class="pull-left">
  <a class="btn btn-primary" type="button" href="/uds/users/adminSplash">Go Back</a>
</div>
<div class="offset5">
  <a class="btn btn-primary" type="button" onclick="document.forms[0].submit();return false;">Save</a>
</div>