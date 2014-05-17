<div class="span10">
	<h2>Survey</h2>
	<div class="row-fluid">
		<div class="pull-left">
			<h4><?php echo $questions[0]['Question']['question']; ?></h4>
		</div>
	</div>
	<?php echo $this->Form->create('Question', array('class' => 'form-horizontal'));?>
	<fieldset>
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
	Age: <input type="text" name="data[User][age]" value="<?php echo $age;?>"/>
	Race:
	<?php 
		$raceList = array("Asian" => "Asian", "White" => "White", "Black"=> "Black", "Other" => "Other"); 
		echo $this->Form->input('User.race', array('label' => false, 'type' => 'select', 'options' => $raceList, 'selected' => $race, 'div'=> false));
	?>
	<br/>
	<br/>
	<?php array_shift($questions); foreach($questions as $question): ?>
	<tr>
		<td>
		<div class="span1">
			<label><?php $i = $question['Question']['qid']; echo $i; ?></label>
		</div>
		</td>
		<td>
		<div class="span5">
			<textarea type="text" class="input-xxlarge" disabled><?php echo $question['Question']['question']; ?></textarea>
		</div>
		</td>
		<?php		
			$comment = "";
			for($j = 1; $j<=5; $j++){
				echo '<td>';
				$value = 0;
				foreach($answers as $answer){
					if($answer['Answer']['qid'] == $i){
						$value = $answer['Answer']['answer'];
					} 
					if($answer['Answer']['qid'] == 13){
						if(!empty($answer['Answer']['answer'])){
							$comment = $answer['Answer']['answer'];
						}					
					}
				}
				if($value == $j){
					echo '<input type="radio" name="'. $i .'" value="'. $j . '" checked>';
				} else {
					echo '<input type="radio" name="'. $i .'" value="'. $j . '">';
				}
				echo '</td>';
			}
		?>
	</tr>
	<?php endforeach; ?>
	<tr>
		<td></td>
		<td><textarea type="text" class="input-xxlarge" placeholder="Your comments..." name="data[Answer][comment]"><?php echo $comment; ?></textarea></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>
</fieldset>
<?php echo $this->Form->end();?>
<div class="pull-left">
  <a class="btn btn-primary" type="button" onclick="document.forms[0].submit();return false;">Save</a>
</div>