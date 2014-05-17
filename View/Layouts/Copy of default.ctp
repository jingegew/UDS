<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo __('Unified Data System:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap-responsive');
		echo $this->Html->css('bootstrap');
		echo $this->Html->script('jquery-1.9.0');
		echo $this->Html->script('jquery-ui-1.10.1.custom');
		echo $this->Html->script('jquery.dataTables.min');
		echo $this->Html->script('bootstrap');
		echo $this->Html->script('main');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
<script src="/capstone/js/jquery-ui-1.8.21.custom.min.js"></script>
<script src="/capstone/js/jquery.dataTables.min.js"></script>
<script src="/capstone/js/bootstrap.js"></script>
<script src="/capstone/js/main.js"></script>
<script src="/capstone/js/jquery-1.9.0.js"></script>
</head>
<body>


		
<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<?php echo $this->Html->link(__('Unified Data System'), 'http://IIS-Jin/capstone', array('class' => 'brand')); ?>
				<!-- start: Header Menu -->
				<div class="btn-group pull-right" >
					<a class="btn" href="#">
						<i class="icon-warning-sign"></i><span class="hidden-phone hidden-tablet"> notifications</span> <span class="label label-important hidden-phone">2</span> <span class="label label-success hidden-phone">11</span>
					</a>
					<a class="btn" href="#">
						<i class="icon-tasks"></i><span class="hidden-phone hidden-tablet"> tasks</span> <span class="label label-warning hidden-phone">17</span>
					</a>
					<a class="btn" href="#">
						<i class="icon-envelope"></i><span class="hidden-phone hidden-tablet"> messages</span> <span class="label label-success hidden-phone">9</span>
					</a>
					<a class="btn" href="#">
						<i class="icon-wrench"></i><span class="hidden-phone hidden-tablet"> settings</span>
					</a>
					<!-- start: User Dropdown -->
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone hidden-tablet"> admin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Profile</a></li>
						<li class="divider"></li>
						<li><a href="/capstone/users/logout"><span class="hidden-tablet"><i class="icon-off"></i>Logout</span></a></li>
					</ul>
					<!-- end: User Dropdown -->
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<div id="under-header"></div>
	<!-- start: Header -->
	
	<div class="container-fluid">
		<div class="row-fluid">
			

			    <!-- Side Navigation -->
    <div class="span2">
      <div class="sidebar-nav">
      	<div class="well" style="padding: 8px 0;">
        <ul class="nav nav-list">
          <li class="nav-header">Projects</li> 
          <li class="active"><a href="/capstone/projects/index"><i class="icon-home"></i> Projects</a></li>
          <li><a href="/capstone/users/index"><i class="icon-user"></i> Members</a></li>
          <li><a href="/capstone/grants/index"><i class="icon-briefcase"></i> Grants</a></li>
          <li><a href="/capstone/agencies/index"><i class="icon-eye-open"></i> Agencies</a></li>
          <li class="nav-header">Experiments</li>
          <li><a href="/capstone/experiments/index"><i class="icon-home"></i> Experiments</a></li>
          <li><a href="/capstone/participants/index"><i class="icon-user"></i> Participants</a></li>
          <li><a href="/capstone/uploads/index"><i class="icon-upload"></i> Upload Data</a></li>
          <li><a href="/capstone/stimuli/index"><i class="icon-fire"></i> Stimulus</a></li>
          <li><a href="/capstone/responses/index"><i class="icon-align-justify"></i> Responses</a></li>
          <li class="nav-header">Admin</li>
          <li><a class="cookie-delete" href="#"><i class="icon-wrench"></i> Settings</a></li>
          <li><a href="/capstone/users/logout"><i class="icon-off"></i> Logout</a></li>
        </ul>
        </div>
      </div><!--/.well -->
    </div><!--/span-->
			

		<div class="span10">
			<!-- start: Content -->			
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Project</a>
					</li>
				</ul>
			</div>
					


			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>

		
				<div class="clearfix"></div>
		<hr>
		
		<footer>
				<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => __('Unified Data System'), 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</footer>
		
	</div>
	</div>
	</div>
	<!-- <?php echo $this->element('sql_dump'); ?> -->
</body>
</html>