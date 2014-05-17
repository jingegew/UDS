<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap-responsive');
		echo $this->Html->css('bootstrap');
		echo $this->Html->script('jquery-1.9.0');
		echo $this->Html->script('jquery-ui-1.10.1.custom');
		echo $this->Html->script('jquery.dataTables.min');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
<script src="/uds/js/jquery-1.9.0.js"></script>	
<script src="/uds/js/jquery-ui-1.8.21.custom.min.js"></script>
<script src="/uds/js/jquery.dataTables.min.js"></script>
<script src="/uds/js/bootstrap.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/uds/css/bootstrap-responsive.css" rel="stylesheet">
	

			<?php echo $this->Session->flash(); ?>			

	<div class="row-fluid">
		<div class="login-box" style="text-align: center">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Form->create(('User'), array('class' => 'form-horizontal', 'inputDefaults' => array('label' => false, 'div' => false))); ?>
				<fieldset>							
					<div class="input-prepend" title="Username">
						<span class="add-on"><i class="icon-envelope"></i></span>
						<?php echo $this->Form->input('email', array('class'=>'input-large span10', 'placeholder' => __('email'), 'type'=> 'email', 'required'=>"required", 'autofocus'=>"autofocus")); ?>
					</div> 					
					<br/>
					<br/>
					<div class="clearfix"></div>
						<div class="input-prepend" title="Password">
							<span class="add-on"><i class="icon-lock"></i></span>
							<?php  echo $this->Form->input('password', array('class'=> 'input-large span10', 'placeholder' => __('password'), 'required'=>"required"));	?>
						</div>
						<br/>
						<?php echo $this->Html->link(__('Forgot password'), array('action' => 'resetPassword'),array('class'=>'btn btn-link')); ?>					
						<br/><br/>
						<div>	
							<button id="login" type="submit" class="btn btn-primary"><?php echo __('Login');?></button>
							<?php echo $this->Html->link(__('Register'), array('action' => 'register'),array('class'=>'btn btn-primary')); ?>
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