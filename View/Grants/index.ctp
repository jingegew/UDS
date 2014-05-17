<?php     
echo $this->Html->script('jquery-1.9.0'); 
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('test');
echo $this->Html->script('jquery-ui-1.10.1.custom');
echo $this->Html->css('jquery-ui-1.10.1.custom');
?>


  <script>
  $(function() {
    $("#start_time" ).datepicker({ dateFormat: 'yy-mm-dd' });   
    $("#end_time" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });  
  </script>


<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable">	
<thead> 
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('agency_id');?></th>
			<th><?php echo $this->Paginator->sort('start_time');?></th>
			<th><?php echo $this->Paginator->sort('end_time');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	</thead> 
	<tbody> 
	<?php
	foreach ($grants as $grant): ?>
	<tr>
		<td><?php echo h($grant['Grant']['id']); ?>&nbsp;</td>
		<td><?php echo h($grant['Grant']['name']); ?>&nbsp;</td>
		<td><?php echo h($grant['Grant']['description']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($grant['Agency']['name'], array('controller' => 'agencies', 'action' => 'view', $grant['Agency']['id'])); ?>
		</td>
		<td><?php echo h($grant['Grant']['start_time']); ?>&nbsp;</td>
		<td><?php echo h($grant['Grant']['end_time']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">				
				<?php 
					echo $this->Html->link(__('View'), array('action' => 'view', $grant['Grant']['id']), array('class' => 'btn btn-mini'));
					$user = $this->Session->read('Auth.User');
					if($user['role_id'] == 1 || $user['id'] == $grant['Grant']['user_id']){
						echo $this->Html->link(__('Edit'), array('action' => 'edit', $grant['Grant']['id']), array('class' => 'btn btn-mini')); 
						echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $grant['Grant']['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $grant['Grant']['id']));
					}			
				?>
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

<?php if($user['role_id'] < 3): ?>
<div>
<!-- Button to trigger modal -->
<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal"><?php echo __('Add Grant');?></a>
</div>
<?php endif; ?>
 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel"><?php echo __('Add Grant');?></h3>
  </div>
  <form accept-charset="utf-8" method="post" id="ProjectIndexForm" action="/uds/grants/add">
  <div class="modal-body">
	<fieldset>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('agency_id');
		echo $this->Form->input('start_time');
		echo $this->Form->input('end_time');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
	

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Close');?></button>
    <button type="submit" class="btn btn-primary"><?php echo __('Add');?></button>
  </div>
  </form>
</div>