<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo __('Unified Data System:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
</head>
<body>
	<div id="container">
		<?php
			echo $content_for_layout; 
		?>
	</div>
</body>
</html>
