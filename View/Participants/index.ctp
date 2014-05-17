<?php     
echo $this->Html->script('jquery-ui-1.10.1.custom');
echo $this->Html->script('TableTools.min');
echo $this->Html->script('ZeroClipboard'); 
echo $this->Html->css('TableTools');
echo $this->Html->css('jquery-ui-1.10.1.custom');
echo $this->Html->css('bootstrap_pagination');
?>
<script>
    $(document).ready(function(){    	
    	$('.popover-test').popover({trigger:'hover', placement:'top'});
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
<form class="form-search">
<input type="text" class="input-medium search-query">
<button type="submit" class="btn"><?php echo __('Search'); ?></button>
</form>
<table class="table datatable dataTable table-hover">
	<thead> 
	<tr>
		<th>ID</th>
		<th><span class="popover-test" data-content="<?php echo $header['Participant']['description']; ?>" data-original-title="Participant ID"><?php echo isset($header['Participant']['id'])? $header['Participant']['id'] : __('Participant'); ?></span></th>
		<?php 
			foreach ($attributes as $attribute) {
				echo '<th><span class="popover-test" data-content="' . $attribute['description'] . '" data-original-title="Participant">' . $attribute['name'] . '</span></th>';
			}
		?>
	</tr>
	</thead> 
	<tbody> 
	<?php foreach ($participants as $participant): ?>
	<tr>
		<td><?php echo $participant['Participant']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($participant['Participant']['uid'], array('controller' => 'participants', 'action' => 'view', $participant['Participant']['id'])); ?>
		</td>
		<?php 
			foreach ($attributes as $attribute) {
				echo "<td>" . $participant['Participant'][$attribute['name']] . "</td>";
			}
		?>
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
<?php endif; ?>