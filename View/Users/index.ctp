<table class="table table-striped bootstrap-datatable" style="white-space:nowrap;">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('last_name');?></th>
			<th><?php echo $this->Paginator->sort('first_name');?></th>
			<th><?php echo $this->Paginator->sort('role_id');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($user['Role']['name'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
		</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td>		
			<?php 
				if($user['User']['status']){
					echo '<span class="label label-success">Active</span>';
				} else {
					echo '<span class="label">Inactive</span>';;
				}
			?>
			&nbsp;		
		</td>
		<td class="actions">
			<div class="btn-toolbar">
				<div class="btn-group">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id']), array('class' => 'btn btn-mini')); ?>					
					<?php 
						$loginUser = $this->Session->read('Auth.User');
						if($loginUser['role_id'] == 1 || $loginUser['id'] == $user['User']['id']){
					 		echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-mini'));  
						}
						if($loginUser['role_id'] == 1){
							if(!$user['User']['status']){
								echo $this->Form->postLink('Activate', array('action' => 'activate', $user['User']['id']), array('class' => 'btn btn-mini'));
							} else {
						    	echo $this->Form->postLink('Deactivate', array('action' => 'deactivate', $user['User']['id']), array('class' => 'btn btn-mini'));
							}
						}
					?>
				</div>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
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

<div> 
	<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">Add User</a>
</div>
 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Add User</h3>
  </div>
  <form accept-charset="utf-8" method="post" id="UserIndexForm" action="/uds/users/add">
  <div class="modal-body">
	<fieldset>
	<?php
		echo $this->Form->input('last_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('role_id');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
	?>
	</fieldset>
	

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button type="submit" class="btn btn-primary">Add</button>
  </div>
  </form>
</div>