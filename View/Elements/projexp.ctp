<script>
$(document).ready(function(){    	
    	$('.popover-test').popover({trigger:'hover', placement:'bottom'});	
});	
</script>
<?php $project = $this->Session->read('Project.name');
if(isset($project)):?>
<div class="row-fluid">
    <div class="span3">
		<?php echo __('Project'); ?>: <span class="popover-test" data-content="<?php echo $this->Session->read('Project.description'); ?>" data-original-title="Project Description"><strong><?php echo $this->Session->read('Project.name'); ?></strong></span>
	</div>
</div>
<?php endif; ?>
<?php $experiment = $this->Session->read('Experiment.name');
if(isset($experiment)):?>
<div class="row-fluid">
	<div class="span3">
		<?php echo __('Experiment'); ?>: <span class="popover-test" data-content="<?php echo $this->Session->read('Experiment.description'); ?>" data-original-title="Experiment Description"><strong><?php echo $this->Session->read('Experiment.name'); ?></strong></span>
	</div>
</div>
<?php endif; ?>