<?php
		echo $this->Html->meta('icon');
		echo $this->Html->script('jquery-ui-1.10.1.custom');
		echo $this->Html->script('jquery.dataTables.min');
		echo $this->Html->script('upload');
		echo $this->Html->css('docs');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
?>
<!-- Bootstrap CSS fixes for IE6 -->
<!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
<!-- Bootstrap Image Gallery styles -->
<link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="/uds/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="/uds/css/jquery.fileupload-ui-noscript.css"></noscript>
<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<?php 
$project = $this->Session->read('Project.id');
if(!isset($project)):?>
<div class="row-fluid">
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><?php echo __('No Project Selected!');?></h4>
  <?php echo __('Please select a project which you would like working on by clicking Projects menu on the left.');?>
</div>
</div>
<?php else: ?>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="/uds/uploads/handler" method="POST" enctype="multipart/form-data">
        <div class="fileupload-buttonbar">
            <div>
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-primary fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span><?php echo __('Add files...');?></span>
                    <input type="file" name="files[]" multiple>
                </span>
                <!--
                <button type="submit" class="btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle"> -->
            </div>
            <!-- The global progress information -->
            <div class="span5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The loading indicator is shown during file processing -->
        <div class="fileupload-loading"></div>
        <br>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
        <div id="result" class="well" align="left" id="holder" ondrop="dropIt(this, event)" ondragenter="return false" ondragover="return false">
        	<span class="label label-important"><?php echo __('Available Columns');?></span>    
        </div>
    </form>
     
    <div class="row-fluid"> 
         <div id="participant_uid" name="<?php echo __('Participant ID');?>" class="span4 well entity-attribute-label" ondrop="dropIt(this, event)" ondragenter="return false" ondragover="return false">
    	 </div>
    	<div id="participants" name="<?php echo __('Participant Attributes');?>" class="span4 well entity-attribute-label" ondrop="dropIt(this, event)" ondragenter="return false" ondragover="return false">
    	</div>
    </div>
    <?php 
$project = $this->Session->read('Experiment.id');
if(!isset($project)):?>
<div class="row-fluid">
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><?php echo __('No Experiment Selected!');?></h4>
  <?php echo __('Please select a experiment before uploading data for stimuli and responses of the experiment by clicking Experiments menu on the left.');?>
</div>
</div>
<?php else: ?>
    <div class="row-fluid"> 
        <div id="stimulus_name" name="<?php echo __('Stimulus Name');?>" class="span4 well entity-attribute-label" ondrop="dropIt(this, event)" ondragenter="return false" ondragover="return false">    		
    	</div>
    	<div id="stimuli" name="<?php echo __('Stimulus Attributes');?>" class="span4 well entity-attribute-label" ondrop="dropIt(this, event)" ondragenter="return false" ondragover="return false">    		
    	</div>
   </div>
   
   <div class="row-fluid"> 
    	<div id="response_value" name="<?php echo __('Response Value');?>" class="span4 well entity-attribute-label" ondrop="dropIt(this, event)" ondragenter="return false" ondragover="return false">    		
    	</div>
    	<div id="response_attributes" name="<?php echo __('Response Attributes');?>" class="span4 well entity-attribute-label" ondrop="dropIt(this, event)" ondragenter="return false" ondragover="return false">    		
    	</div>
   </div>
   <!--
   <div class="row-fluid"> 
    	<div id="response_date" name="Response Date" class="span4 well entity-attribute-label" ondrop="dropIt(this, event)" ondragenter="return false" ondragover="return false">
    	</div>
   </div>
   
   <div class="row-fluid"> 
    	<div id="response_start_time" name="Response Start Time" class="span4 well entity-attribute-label" ondrop="dropIt(this, event)" ondragenter="return false" ondragover="return false">    		
    	</div>
   </div>
   
   <div class="row-fluid"> 
    	<div id="response_end_time" name="Response End Time" class="span4 well entity-attribute-label" ondrop="dropIt(this, event)" ondragenter="return false" ondragover="return false">    		
    	</div>
   </div>
   
   <div class="row-fluid"> 
    	<div id="response_misc_note" name="Response Misc Note" class="span4 well entity-attribute-label" ondrop="dropIt(this, event)" ondragenter="return false" ondragover="return false">    		
    	</div>
   </div>
   -->
<?php endif; ?>
   <div class="row-fluid"> 
   <a id="mapAll" class="btn btn-primary" href="#"><i class=" icon-arrow-up icon-white"></i> <?php echo __('Upload Data');?></a>
   </div>
<?php endif; ?>
<script>
$("#mapAll").click(function() {
  	var dataJson = {};
 	var stimulusObj = {};
 	var participantObj = {};
 	var responseObj = {};
 	stimulusObj.attributes = {};
 	participantObj.attributes = {};
 	responseObj.attributes = {};
 	
	$("#participants > input").each(function() {
      participantObj['attributes'][$(this).attr("id")] = $(this).val();
	});
	
	$("#participant_uid > input").each(function() {
      participantObj['uid'] = $(this).attr("id");
      participantObj['uid_name'] = $(this).val();
	});
	
	$("#stimuli > input").each(function() {
      stimulusObj['attributes'][$(this).attr("id")] = $(this).val();
	});	
	
	$("#stimulus_name > input").each(function() {
      stimulusObj['name'] = $(this).attr("id");
      stimulusObj['name_name'] = $(this).val();
	});	
	
	$("#response_attributes > input").each(function() {
      responseObj['attributes'][$(this).attr("id")] = $(this).val();
	});
	
	$("#response_value > input").each(function() {
      responseObj['value'] = $(this).attr("id");
      responseObj['value_name'] = $(this).val();
	});
			
	dataJson.stimulus = stimulusObj;
	dataJson.participant = participantObj;
	dataJson.response = responseObj;
 
 	alert("DATA: " + JSON.stringify(dataJson));
 	
	$.ajax({
  		type: 'POST',
  		url: '<?php echo $this->Html->url(array("controller" => "uploads","action" => "map"));?>',
  		dataType: 'json', 
        contentType: 'json', 
  		data: JSON.stringify(dataJson),
  		timeout:3600000
	}).done(function (response) {
		$("#msg").html('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>'+ response.message +'</div>');
	});
});

$("#result").click(function() {
   	 $.ajax({
            type: 'POST',
            url: '<?php echo $this->Html->url(array("controller" => "uploads","action" => "getColumns"));?>',
            success:function(data){
            	document.getElementById("result").innerHTML+=data + "<br>";
            },
            error:function(){
            }
        });
});
</script>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important"><?php echo __('Error');?></span> {%=file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            </td>
            <td class="start">{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary">
                    <i class="icon-upload icon-white"></i>
                    <span><?php echo __('Start');?></span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td class="cancel">{% if (!i) { %}
            <button class="btn btn-warning">
                <i class="icon-ban-circle icon-white"></i>
                <span><?php echo __('Cancel');?></span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>            
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else { %}
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
            <td class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="uploader"><span>{%=file.uploader%}</span></td>
            <td colspan="2"></td>
        {% } %}
        <td class="delete">
            <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                <i class="icon-trash icon-white"></i>
                <span><?php echo __('Delete');?></span>
            </button>
        </td>
    </tr>
{% } %}
</script>


<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="/uds/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="/uds/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.com/JavaScript-Load-Image/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.com/JavaScript-Canvas-to-Blob/canvas-to-blob.min.js"></script>
<script src="http://blueimp.github.com/Bootstrap-Image-Gallery/js/bootstrap-image-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="/uds/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="/uds/js/jquery.fileupload.js"></script>
<!-- The File Upload file processing plugin -->
<script src="/uds/js/jquery.fileupload-fp.js"></script>
<!-- The File Upload user interface plugin -->
<script src="/uds/js/jquery.fileupload-ui.js"></script>

<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="uds/js/cors/jquery.xdr-transport.js"></script><![endif]-->