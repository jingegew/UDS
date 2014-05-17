<script>

$(function() {

	$("#approveButton").click(function() {
		var sList = "";
		$('input[type=checkbox]').each(function () {
           if(this.checked) {
               sList += $(this).val() + " ";
           }
		});
		console.log(sList);
		$("#userIDs").val($.trim(sList));
	});
	
	$("#declineButton").click(function() {
		var sList = "";
		$('input[type=checkbox]').each(function () {
           if(this.checked) {
               sList += $(this).val() + " ";
           }
		});
		$("#declineUserIDs").val($.trim(sList));
	});
    
}); 
</script>
<div>
<h4>Pending Registrations</h4>
</div>
<table class="table table-striped bootstrap-datatable" style="white-space:nowrap;">	<tr>
			<th><input type="checkbox" onClick="toggle(this)" />Select All</th>
			<th>Last Name</th>
			<th>First Name</th>
			<th>Role</th>
			<th>Email</th>
			<th>Status</th>
	</tr>
	<?php
	foreach ($users as $user): ?>
	<tr>
		<td><input type = "checkbox" name = "userID" id = "userID" value = "<?php echo $user['User']['id']; ?>"/></td>
		<td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
		<td>
			<?php echo $user['Role']['name']; ?>
		</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td>		
			<?php 
				if($user['User']['status'] == 1){
					echo '<span class="label label-success">Active</span>';
				}
				if($user['User']['status'] == 0) {
					echo '<span class="label">Inactive</span>';;
				}
				if($user['User']['status'] == -1) {
					echo '<span class="label">Declined</span>';;
				}
			?>
			&nbsp;		
		</td>
	</tr>
<?php endforeach; ?>
	</table>
<br/>

<div class="row_fluid">
<div class="input-prepend input-append pull-left">
    <form action="/uds/users/update" method="post" onsubmit="return confirm('Are you sure you want to approve?')">
   		<input id="userIDs" name="data[user_ids]" type="hidden" value=""/>
    	<span class="add-on">Approve As</span>
		<?php echo $this->Form->input('role_id', array('label' => false, 'div' => false, 'class' => 'input-medium')); ?>
		<button id="approveButton" type="submit" class="btn btn-primary">GO</button>
    </form>
</div>

<div class="pull-right">
	<form action="/uds/users/decline" method="post" onsubmit="return confirm('Are you sure you want to decline?')">
   		<input id="declineUserIDs" name="data[user_ids]" type="hidden" value=""/>
		<button id="declineButton" type="submit" class="btn btn-primary">Decline</button>
    </form>
</div>
</div>

