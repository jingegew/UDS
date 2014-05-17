<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>
		<?php echo 'UDS: ' . $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap-responsive');
		echo $this->Html->css('bootstrap');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('jquery-ui-1.10.1.custom');
		echo $this->Html->css('jquery-ui-1.10.1.custom');
		$languages = array(
    		"fra" => "français",
    		"ru" => "Русский",
    		"hi" => "हिन्दी",
    		"ar" => "العربية",
    		"fa" => "فارسی",
    		"de" => "Deutsch",
    		"en" => "English",
    		"es" => "Español",
    		"pt" => "Português",
    		"ja" => "日本語",
    		"zh-cn" => "简体中文",
    		"zh-tw" => "繁體中文",
    		"ko" => "한국어"
		);
	?>
<script src="/uds/js/jquery-1.9.0.js"></script>	
<script src="/uds/js/jquery-ui-1.8.21.custom.min.js"></script>
<script src="/uds/js/jquery.dataTables.min.js"></script>
<script src="/uds/js/bootstrap.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/uds/css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>		
<!-- start: Header -->
	<div class="navbar">
		<div class="nav-header">
			<div class="navbar-inner">
				<div class="container">
        		<?php echo $this->Html->link(__('Unified Data System'), 'http://141.225.41.243/uds', array('class' => 'brand'));?>
				<!-- start: Header Menu -->
				<div class="pull-right">
				<div class="btn-group" >
					<!-- start: LANG Dropdown -->
					<button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                        <small>
                        	<?php 
                        		echo __('Language:');
                        		$lang = $this->Session->read('Config.language');
                        		if(!isset($lang)){
                        			$lang = 'en';
                        		}
                        	?>
                        </small>
                        <span class="js-current-language"><?php echo $languages[$lang];?></span>
                        <b class="caret"></b>
                    </button>
					<ul class="dropdown-menu">
						<li class="dropdown-caret right">
                          <span class="caret-outer"></span>
                          <span class="caret-inner"></span>
                        </li>
                          <li><a class="js-language-link" title="German" data-lang-code="de" href="?lang=de">Deutsch</a></li>
                          <li><a class="js-language-link" title="English" data-lang-code="en" href="?lang=en">English</a></li>
                          <li><a class="js-language-link" title="Spanish" data-lang-code="es" href="?lang=es">Español</a></li>
                          <li><a class="js-language-link" title="Dutch" data-lang-code="nl" href="?lang=nl">Nederlands</a></li>
                          <li><a class="js-language-link" title="Portuguese" data-lang-code="pt" href="?lang=pt">Português</a></li>
                          <li><a class="js-language-link" title="French" data-lang-code="fra" href="?lang=fra">français</a></li>
                          <li><a class="js-language-link" title="Russian" data-lang-code="ru" href="?lang=ru">Русский</a></li>
                          <li><a class="js-language-link" title="Arabic" data-lang-code="ar" href="?lang=ar">العربية</a></li>
                          <li><a class="js-language-link" title="Farsi" data-lang-code="fa" href="?lang=fa">فارسی</a></li>
                          <li><a class="js-language-link" title="Hindi" data-lang-code="hi" href="?lang=hi">हिन्दी</a></li>
                          <li><a class="js-language-link" title="Japanese" data-lang-code="ja" href="?lang=ja">日本語</a></li>
                          <li><a class="js-language-link" title="Simplified Chinese" data-lang-code="zh-cn" href="?lang=zh-cn">简体中文</a></li>
                          <li><a class="js-language-link" title="Traditional Chinese" data-lang-code="zh-tw" href="?lang=zh-tw">繁體中文</a></li>
                          <li><a class="js-language-link" title="Korean" data-lang-code="ko" href="?lang=ko">한국어</a></li>
					</ul>
					<!-- end: LANG Dropdown -->	
				</div>				
				<div class="btn-group" >
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
   						 		echo '<li>' . $this->Html->link(__('Profile'), array('controller'=> 'users','action' => 'profile')) . '</li>';						
								echo '<li class="divider"></li>';
							}
						 ?>
						<li><a href="/uds/users/logout"><span class="hidden-tablet"><i class="icon-off"></i>&nbsp;<?php echo __('Logout');?></span></a></li>
					</ul>
					<!-- end: User Dropdown -->
					
				</div>
				<!-- end: Header Menu -->	
				</div>
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
          <li class="nav-header"><?php echo __('Project');?></li> 
          <li class="active"><a href="/uds/projects/index"><i class="icon-home"></i> <?php echo __('Projects');?></a></li>
          <li><a href="/uds/grants/index"><i class="icon-briefcase"></i> <?php echo __('Grants');?></a></li>
          <li><a href="/uds/agencies/index"><i class="icon-eye-open"></i> <?php echo __('Funding Agencies');?></a></li>
          <li class="nav-header"><?php echo __('Experiment');?></li>
          <li><a href="/uds/experiments/index"><i class="icon-home"></i> <?php echo __('Experiments');?></a></li>
          <li><a href="/uds/attributes/index"><i class="icon-list-alt"></i> <?php echo __('Attributes');?></a></li>
          <li><a href="/uds/participants/index"><i class="icon-user"></i> <?php echo __('Participants');?></a></li>
          <li><a href="/uds/stimuli/index"><i class="icon-fire"></i> <?php echo __('Stimulus');?></a></li>
          <li><a href="/uds/responses/index"><i class="icon-align-justify"></i> <?php echo __('Responses');?></a></li>
          <li><a href="/uds/uploads/index"><i class="icon-upload"></i> <?php echo __('Upload Data');?></a></li>
          <?php endif; ?>
          <?php if($user['role_id'] == 1): ?>
          <li class="nav-header"><?php echo __('Admin');?></li>
          <li><a href="/uds/users/adminSplash"><i class="icon-user"></i> Pending Registrations</a></li>
          <li><a href="/uds/users/index"><i class="icon-user"></i> Users</a></li>
          <li><a href="/uds/roles/index"><i class="icon-flag"></i> Roles</a></li>
          <li><a href="/uds/questions/add"><i class="icon-flag"></i> Edit Survey</a></li>
          <?php endif; ?>
          <li class="nav-header"><?php echo __('Feedback');?></li>
		  <?php if($user['role_id'] > 1): ?>
		  <li><a href="/uds/questions/index"><i class="icon-flag"></i> <?php echo __('Take Survey');?></a></li>
		  <?php endif; ?>
		  <li><a href="/uds/questions/visualize"><i class="icon-flag"></i> <?php echo __('Survey Results');?></a></li>
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
						<a href=""><?php echo __('Home');?></a> <span class="divider">/</span>
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
			<div id='msg'></div>
			<?php echo $this->element('projexp'); ?>
			<?php echo $this->fetch('content'); ?>		
	    </div>	    
	</div>
	
<div class="clearfix"></div>
<hr>	
<div class="footer" id="footer" align="center">
      <ul class="inline">
          <li>©2013 UDS</li>
          <li><a href="/uds/pages/about"><?php echo __('About Me');?></a></li>
          <li><a href="/uds/pages/contact"><?php echo __('Contact');?></a></li>
          <li><a href="/uds/pages/api"><?php echo __('API');?></a></li>
          <li><a href="/uds/pages/help"><?php echo __('Help');?></a></li>
          <li><a href="/uds/pages/term_privacy"><?php echo __('Terms & Privacy');?></a></li>
      </ul>
      <p class="pull-right">
		<?php echo $this->Html->link($this->Html->image('uds_logo.jpg', array('alt' => __('Unified Data System'), 'border' => '0')), 'http://141.225.41.243/uds', array('target' => '_blank', 'escape' => false));?>
	  </p>	  
</div>
		
</div>
<!-- ?php echo $this->element('sql_dump'); ? -->
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
</body>
</html>