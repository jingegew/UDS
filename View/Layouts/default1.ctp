<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin Simplenso - Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="HTML5 Admin Simplenso Template">

   
  <!-- Bootstrap Image Gallery styles -->
  <link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css">
  
  <!-- Uniform -->
  <link rel="stylesheet" type="text/css" media="screen,projection" href="scripts/uniform/css/uniform.default.css" />
  
  <!-- Chosen multiselect -->
  <link type="text/css" href="scripts/chosen/chosen/chosen.intenso.css" rel="stylesheet" />   

  <!-- Simplenso -->
  <link href="css/simplenso.css" rel="stylesheet">
  
  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- Le fav and touch icons -->
  <link rel="shortcut icon" href="images/ico/favicon.ico">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
  	<?php
		echo $this->Html->meta('icon');


		echo $this->Html->css('my.cake');
		echo $this->Html->css('bootstrap-responsive');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('style');
		echo $this->Html->css('style-responsive');
		echo $this->Html->script('jquery-1.9.0');
		echo $this->Html->script('jquery-ui-1.8.21.custom.min');
		echo $this->Html->script('bootstrap');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>


<body>
<!-- Top navigation bar -->
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="index.html">Simplenso</a>
      <div class="btn-group pull-right">
        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
          <i class="icon-user"></i> John Doe
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Profile</a></li>
          <li><a href="#">Settings</a></li>
          <li><a class="cookie-delete" href="#">Delete Cookies</a></li>
          <li class="divider"></li>
          <li><a href="login.html">Logout</a></li>
        </ul>
      </div>
      <div class="nav-collapse">
        <ul class="nav">
          <li class="dropdown">
              <a href="#"
                    class="dropdown-toggle"
                    data-toggle="dropdown">
                    Messages <span class="badge badge-info">100</span>
                    <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                  <li><a href="#">Message 1</a></li>
                  <li><a href="#">Another message</a></li>
                  <li><a href="#">Something else message</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Older messages...</a></li>
              </ul>
          </li>
          <li class="dropdown">
                <a href="#"
                      class="dropdown-toggle"
                      data-toggle="dropdown">
                      Settings
                      <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Personal Info</a></li>
                    <li><a href="#">Preferences</a></li>
                    <li><a href="#">Alerts</a></li>
                    <li><a class="cookie-delete" href="#">Delete Cookies</a></li>
                </ul>
          </li>
          <li class="dropdown">
                <a href="#"
                      class="dropdown-toggle"
                      data-toggle="dropdown">
                      Theme
                      <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                	<li><a class="theme-switch-default" href="#">Default</a></li>
                    <li><a class="theme-switch-amelia" href="#">Amelia</a></li>
                    <li><a class="theme-switch-cerulean" href="#">Cerulean</a></li>
                    <li><a class="theme-switch-cosmo" href="#">Cosmo</a></li>
                    <li><a class="theme-switch-journal" href="#">Journal</a></li>                        
                    <li><a class="theme-switch-readable" href="#">Readable</a></li>
                    <li><a class="theme-switch-simplex" href="#">Simplex</a></li>
                    <li><a class="theme-switch-slate" href="#">Slate</a></li>
                    <li><a class="theme-switch-spacelab" href="#">Spacelab</a></li>
                    <li><a class="theme-switch-spruce" href="#">Spruce</a></li>
                    <li><a class="theme-switch-superhero" href="#">Superhero</a></li>
                    <li><a class="theme-switch-united" href="#">United</a></li>
                </ul>
          </li>
          <li><a href="#">Help</a></li>  
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>
<!-- Main Content Area | Side Nav | Content -->    
<div class="container-fluid">
  <div class="row-fluid">
    <!-- Side Navigation -->
    <div class="span2">
      <div class="member-box round-all"> 
        <a><img src="images/member_ph.png" class="member-box-avatar" /></a>
        <span>
            <strong>Administrator</strong><br/>
            <a>John Doe</a><br/>
            <span class="member-box-links"><a>Settings</a> | <a>Logout</a></span>
        </span>
      </div>          
      <div class="sidebar-nav">
      	<div class="well" style="padding: 8px 0;">
        <ul class="nav nav-list"> 
          <li class="nav-header">Main</li>        
          <li class="active"><a href="index.html"><i class="icon-home"></i> Dashboard</a></li>
          <li><a href="blogpost.html"><i class="icon-edit"></i> Add Blog Post</a></li>
          <li><a href="members.html"><i class="icon-user"></i> Members</a></li>
          <li><a href="comments.html"><i class="icon-comment"></i> Comments</a></li>
          <li><a href="gallery.html"><i class="icon-picture"></i> Gallery</a></li>
          <li><a href="calendar.html"><i class="icon-calendar"></i> Calendar</a></li>
          <li class="nav-header">Typography</li>
          <li><a href="typography.html"><i class="icon-font"></i> Typography</a></li>
          <li><a href="grid.html"><i class="icon-th-large"></i> Grid</a></li>
          <li><a href="portlets.html"><i class="icon-th"></i> Portlets</a></li>
          <li><a href="forms.html"><i class="icon-th"></i> Forms</a></li>
          <li><a href="tables.html"><i class="icon-align-justify"></i> Tables</a></li>
          <li><a href="other.html"><i class="icon-gift"></i> Other</a></li>
          <li class="nav-header">Cookies</li>
          <li><a class="cookie-delete" href="#"><i class="icon-wrench"></i> Delete Cookies</a></li>
          <li><a class="sidenav-style-1" href="#"><i class="icon-align-left"></i> Side Menu Style 1</a></li>
          <li><a class="sidenav-style-2" href="#"><i class="icon-align-right"></i> Side Menu Style 2</a></li>
          <li><a href="login.html"><i class="icon-off"></i> Logout</a></li>
        </ul>
        </div>
      </div><!--/.well -->
    </div><!--/span-->
    
    <!-- Bread Crumb Navigation -->
	<div class="span10">
      <div>
        <ul class="breadcrumb">
          <li>
            <a href="#">Home</a> <span class="divider">/</span>
          </li>
          <li>
            <a href="#">Library</a> <span class="divider">/</span>
          </li>
          <li class="active">Data</li>
        </ul>
      </div>

      <!-- Geographic Page Visit Map -->
      <div class="row-fluid">
        
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
      </div>
	  
 
  <footer>
    <p>&copy; Simplenso 2012</p>
  </footer>
    <div id="box-config-modal" class="modal hide fade in" style="display: none;">
      <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Adjust widget</h3>
      </div>
      <div class="modal-body">
        <p>This part can be customized to set box content specifix settings!</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal">Save Changes</a>
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
      </div>
    </div>
</div><!--/.fluid-container-->

  </body>
</html>