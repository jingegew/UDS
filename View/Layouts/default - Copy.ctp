<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Unified Data System:<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap-responsive');
		echo $this->Html->css('bootstrap');
		echo $this->Html->script('jquery-1.9.0');
		echo $this->Html->script('bootstrap');
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

<script>
$(function(){
  function getEntity(str) {	  
	 var n=str.indexOf("/uds/");	  
	 var str1 = str.substr(n + 5);
	 if(str1.indexOf("/") > 0){
		 return str1.substr(0, str1.indexOf("/"));
	 } else {
		 return str1.substr(0); 
	 }	 
  }
  function getAction(str) {	  
	 var n=str.indexOf("/uds/");	  
	 var str1 = str.substr(n + 5);
	 if(str1.indexOf("/") > 0){
		 return str1.substr(str1.indexOf("/"));
	 } else {
		 return "index"; 
	 }	 
  }
  var url = window.location.pathname; 
  var activeEntity = getEntity(url);
  var activeAction = getAction(url);
  $('.nav li a').each(function(){  
    var currentEntity = getEntity($(this).attr('href'));
    var currentAction = getAction($(this).attr('href'));
    if ((activeEntity == currentEntity) && (activeAction == currentAction)) {
        $(this).parent().addClass('active').siblings().removeClass('active');
    }
  });
});
</script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/uds/css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>		
<!-- start: Header -->
	<div class="navbar">
		<div class="nav-header">
			<div class="navbar-inner">
				<div class="container">
        			<?php echo $this->Html->link('Unified Data System', 'http://IIS-Jin/uds', array('class' => 'brand'));	?>
				
				<!-- start: Header Menu -->
				<div class="btn-group pull-right" >
					<!-- start: User Dropdown -->
					<button class="btn dropdown-toggle" data-toggle="dropdown">
						<i class="icon-user"></i><span class="hidden-phone hidden-tablet"> 
						<?php 
							$user = $this->Session->read('Auth.User');
							if(!empty($user)) { 
   						 		echo $user['first_name'] . " " . $user['last_name'];
							} else {
								echo "Guest";
							}
						 ?></span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php 
							if(!empty($user)) {
   						 		echo '<li>' . $this->Html->link('Profile', array('controller'=> 'users','action' => 'profile')) . '</li>';						
								echo '<li class="divider"></li>';
							}
						 ?>
						<li><a href="/uds/users/logout"><span class="hidden-tablet"><i class="icon-off"></i>&nbsp;Logout</span></a></li>
					</ul>
					<!-- end: User Dropdown -->
				</div>
				<!-- end: Header Menu -->	
     			</div>
				
			</div>

		</div>		
	</div>
	
	<!-- start: Header -->
	
	<div class="container-fluid">
		
	<div class="row-fluid">
	<?php if(isset($user['role_id'])): ?>
	<!-- Side Navigation -->
	<div class="span2">
      <div class="sidebar-nav">
      	<div class="well" style="padding: 8px 0;">
        <ul class="nav nav-list">
          <?php if($user['role_id'] != 1): ?>
          <li class="nav-header">Projects</li> 
          <li class="active"><a href="/uds/projects/index"><i class="icon-home"></i> Projects</a></li>
          <li><a href="/uds/grants/index"><i class="icon-briefcase"></i> Grants</a></li>
          <li><a href="/uds/agencies/index"><i class="icon-eye-open"></i> Agencies</a></li>
          <li class="nav-header">Experiments</li>
          <li><a href="/uds/experiments/index"><i class="icon-home"></i> Experiments</a></li>
          <li><a href="/uds/attributes/index"><i class="icon-list-alt"></i> Attributes</a></li>
          <li><a href="/uds/participants/index"><i class="icon-user"></i> Participants</a></li>
          <li><a href="/uds/stimuli/index"><i class="icon-fire"></i> Stimulus</a></li>
          <li><a href="/uds/responses/index"><i class="icon-align-justify"></i> Responses</a></li>
          <li><a href="/uds/uploads/index"><i class="icon-upload"></i> Upload Data</a></li>
          <?php endif; ?>
          <?php if($user['role_id'] == 1): ?>
          <li class="nav-header">Admin</li>
          <li><a href="/uds/users/adminSplash"><i class="icon-user"></i> Pending Registrations</a></li>
          <li><a href="/uds/users/index"><i class="icon-user"></i> Users</a></li>
          <li><a href="/uds/roles/index"><i class="icon-flag"></i> Roles</a></li>
          <li><a href="/uds/questions/add"><i class="icon-flag"></i> Edit Survey</a></li>
          <?php endif; ?>
          <li class="nav-header">Feedback</li>
		  <?php if($user['role_id'] > 1): ?>
		  <li><a href="/uds/questions/index"><i class="icon-flag"></i> Take Survey</a></li>
		  <?php endif; ?>
		  <li><a href="/uds/questions/visualize"><i class="icon-flag"></i> Survey Results</a></li>
        </ul>
        </div>
      </div>
    </div>		
	<?php endif; ?>
	
	<div class="span10">
			<!-- start: Content -->			
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="">Home</a> <span class="divider">/</span>
					</li>
					<?php						
						$urls = $this->Session->read('navigation');	
						$url = array_pop($urls);			
						foreach ($urls as $key => $value){
    						echo '<li><a href="' . $key . '">' . $value . '</a><span class="divider">/</span></li>';
						}
						echo '<li class="active">' . $url . '</li>';
					?>
				</ul>
			</div>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>		
	    </div>	    
	</div>
	
<div class="clearfix"></div>
	<hr>
	<!--		
	<footer>
	<div class="row-fluid">
	<div class="offset4">
		Copyright@The University of Memphis, 2013
	</div>
	</div>
	</footer>
	-->
	<footer>
	<p class="pull-right">
		<?php echo $this->Html->link($this->Html->image('uds_logo.jpg', array('alt' => __('Unified Data System'), 'border' => '0')), 'http://iis-jin/uds', array('target' => '_blank', 'escape' => false));?>
	</p>
	</footer>		
</div>
<!-- <?php echo $this->element('sql_dump'); ?> -->
</body>
</html>