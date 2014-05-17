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
    		"zho" => "繁體中文",
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
                          <li><a class="js-language-link" title="Traditional Chinese" data-lang-code="zho" href="?lang=zho">繁體中文</a></li>
                          <li><a class="js-language-link" title="Korean" data-lang-code="ko" href="?lang=ko">한국어</a></li>
					</ul>
					<!-- end: LANG Dropdown -->	
				</div>
				<!-- end: Header Menu -->	
				</div>
     			</div>
				
			</div>

		</div>		
	</div>
	
	<!-- start: Header -->

<div class="container">

<?php echo $this->fetch('content'); ?>

</div>
  
<div class="clearfix"></div>
<hr/>
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

	<script src="/uds/js/jquery-1.9.0.js"></script>	
	<script src="/uds/js/jquery-ui-1.8.21.custom.min.js"></script>
	<script src="/uds/js/bootstrap.js"></script>
  </body>
</html>