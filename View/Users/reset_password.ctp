		
<div class="row-fluid">	
<!-- start: Content -->			

			<?php echo $this->Session->flash(); ?>			

	<div class="row-fluid">
		<div class="login-box" style="text-align: center">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Form->create(('User'), array('class' => 'form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false))); ?>
				<fieldset>							
					<div class="input-prepend" title="Username">
						<span class="add-on"><i class="icon-envelope"></i></span>
						<?php echo $this->Form->input(('email'), array('class'=>'input-large span10', 'placeholder' => __('email'), 'type'=> 'email', 'required'=>"required", 'autofocus'=>"autofocus")); ?>
					</div> 					
					<br/>
					<br/>
					<div class="clearfix"></div>
						<div class="input-prepend" title="Last Name">
							<span class="add-on"><i class="icon-user"></i></span>
							<?php  echo $this->Form->input('last_name', array('class'=> 'input-large span10', 'placeholder' => __('Last Name'), 'required'=>"required"));	?>
						</div>
						<br/><br/>
						<div>	
							<?php echo $this->Html->link(__('Go Back'), array('action' => 'login'),array('class'=>'btn btn-primary')); ?>
							<button id="login" type="submit" class="btn btn-primary"><?php echo __('Reset Password'); ?></button>
						</div>
			</form>
		</div>
	</div>
</div>
	
<script>
$(function() {
	$('#login').click(function(){
	    $("#login").attr("action", "/uds/users");
	});
	
	$('#resetPassword').click(function(){
	    $("#UserLoginForm").attr("action", "/uds/users/resetPassword");
	});
	
});
</script>
