<?php
	echo $this->Html->script('jquery-1.9.0');
	echo $this->Html->script('bootstrap-fileupload');
	echo $this->Html->css('bootstrap-fileupload');
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

<script>
$(function() {

  	$("#ResponseDate" ).datepicker({ dateFormat: 'yy-mm-dd' });
    
    $('input[type="radio"]').change(function(){    
    	if($('#manually').is(':checked')) {
    		 $('#table').show();
    		 $('#fileSelect').hide();
    		 $('#excel').hide();
    	}     	    	
    	if($('#import').is(':checked')) {
    		 $('#fileSelect').show();
    		 $('#excel').show();
    		 $('#table').hide();    		 
    	}    	
	});	
	$("#manually").tooltip();  
	$("#import").tooltip(); 
	$("#ParticipantUID").tooltip(); 
	$("#StimulusName").tooltip();	
});	
</script>

<h4>Uploading Data for</h4>
	
<div class="row-fluid">
    <div class="span3">
		Project:<strong><?php echo $this->Session->read('Project.name'); ?></strong>
	</div>
	<div class="span6">
		Description:<strong><?php echo $this->Session->read('Project.description'); ?></strong>
	</div>
</div>	
<div class="row-fluid">
	<div class="span3">
		Experiment:<strong><?php echo $this->Session->read('Experiment.name'); ?></strong>
	</div>
	<div class="span6">
		Description:<strong><?php echo $this->Session->read('Experiment.description'); ?></strong>
	</div>
</div>
<div class="row-fluid">	
	<div class="span3">
		Stimuli
	</div>
	<div class="span3">
		Responses
	</div>
</div>
<div class="row-fluid">	
	<div class="span3">
		<textarea id="stimuli" name="data[stimuli]" disabled><?php echo $stimuliStr; ?></textarea>
	</div>
	<div class="span3">
		<textarea id="responses" name="data[responses]" disabled><?php echo $responseStr; ?></textarea>
	</div>
</div>
<div class="row-fluid">
<div class="pull-left span6">
	<label class="radio inline">Add Data</label>
	<label class="radio inline"><input type="radio" name="mode" id="manually" checked data-placement="top" data-original-title="Click to add experimental data manually.">Manually</label>
	&nbsp;&nbsp;
	<label class="radio inline"><input type="radio" name="mode" id="import" data-placement="top" data-original-title="Click to show upload file panel.">Import</label>
</div>
</div>

<div id="fileSelect" style="display:none" class="row-fluid">
<form id="fileupload" action="/uds/uploads/handler" method="POST" enctype="multipart/form-data">
    <div class="fileupload-buttonbar">
         <div>
              <span class="btn btn-primary fileinput-button">
                  <i class="icon-plus icon-white"></i>
                  <span>Add files...</span>
                  <input type="file" name="files[]" multiple>
              </span>
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
</form>
</div>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            </td>
            <td class="start">{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary">
                    <i class="icon-upload icon-white"></i>
                    <span>Start</span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td class="cancel">{% if (!i) { %}
            <button class="btn btn-warning">
                <i class="icon-ban-circle icon-white"></i>
                <span>Cancel</span>
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
            <td colspan="2"></td>
        {% } %}
        <td class="delete">
            <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                <i class="icon-trash icon-white"></i>
                <span>Delete</span>
            </button>
        </td>
    </tr>
{% } %}
</script>


<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="/uds/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="http://blueimp.github.com/JavaScript-Templates/tmpl.min.js"></script>
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
<div class="row-fluid">
<div class="pull-left span6">
(Fields marked * are required.)
</div>
</div>
<div class="row-fluid">
<div class="span9">
    <div class="row-fluid">    
 
      <div id="table" class="span7">
      <form accept-charset="utf-8" method="post" id="AddForm" action="/uds/uploads/add">
        <div class="row-fluid">
          <div class="span5"><label>Stimulus Name *</label></div>
          <div class="span3"><input id="StimulusName" type="text" name="data[Stimulus][name]"></div>
        </div>
         <div class="row-fluid">
          <div class="span5"><label>Stimulus Category</label></div>
          <div class="span3"><input id="StimulusCategory" type="text" name="data[Stimulus][category]"></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Participant ID *</label></div>
          <div class="span3"><input id="ParticipantID" data-placement="top" data-original-title="Participant ID should be unique." type="text" name="data[Participant][uid]"></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Participant Name</label></div>
          <div class="span3"><input id="ParticipantName" type="text" name="data[Participant][name]"></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Participant Age</label></div>
          <div class="span3"><input id="ParticipantAge" type="text" name="data[Participant][age]"></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Participant Race</label></div>
          <div class="span3"><input id="ParticipantRace" type="text" name="data[Participant][race]"></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Response Value *</label></div>
          <div class="span3"><input id="ResponseValue" type="text" name="data[Response][value]"></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Response Date</label></div>
          <div class="span3"><input id="ResponseDate" type="text" name="data[Response][date]"></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Response Note</label></div>
          <div class="span3"><input id="ResponseNote" type="text" name="data[Response][note]"></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Response Start Time</label></div>
          <div class="span3"><input id="ResponseStartTime" type="text" name="data[Response][start_time]"></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Response End Time</label></div>
          <div class="span3"><input id="ResponseEndTime" type="text" name="data[Response][end_time]"></div>
        </div>
        
        <div class="pull-left">
   			<a class="btn btn-primary" type="button" href="/uds/experiments/index">Go Back</a>
		</div>
		<div class="offset5">
    		<a class="btn btn-primary" type="button" onclick="$('#AddForm').submit();return false;">Save</a>
		</div>       
       </form>
      </div>
      
      <div id="excel" style="display:none" class="span6">
      <form accept-charset="utf-8" method="post" id="UploadForm" action="/uds/uploads/mapping">
      	
      	<div class="row-fluid">
      	  <div class="span5"><label></label></div>
          <div class="span5"><a id="getColumn" class="btn btn-small" type="button">Load Columns</a></div>
        </div>
      	<div class="row-fluid">
          <div class="span5"><label class="required">Stimulus Name</label></div>
          <div class="span3"><select id="StimulusName" data-placement="top" data-original-title="Stimulus Name is required." name="data[Stimulus][name]"></select></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Stimulus Category</label></div>
          <div class="span3"><select id="StimulusCategory" type="text" name="data[Stimulus][category]"></select></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Participant ID *</label></div>
          <div class="span3"><select id="ParticipantUID" data-placement="top" data-original-title="Participant ID should be unique." type="text" name="data[Participant][uid]"></select></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Participant Name</label></div>
          <div class="span3"><select id="ParticipantName" type="text" name="data[Participant][name]"></select></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Participant Age</label></div>
          <div class="span3"><select id="ParticipantAge" type="text" name="data[Participant][age]"></select></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Participant Race</label></div>
          <div class="span3"><select id="ParticipantRace" type="text" name="data[Participant][race]"></select></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Response Value *</label></div>
          <div class="span3"><select id="ResponseValue" type="text" name="data[Response][value]"></select></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Response Date</label></div>
          <div class="span3"><select type="text" name="data[Response][date]"></select></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Response Note</label></div>
          <div class="span3"><select id="ResponseNote" type="text" name="data[Response][note]"></select></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Response Start Time</label></div>
          <div class="span3"><select id="ResponseStartTime" type="text" name="data[Response][start_time]"></select></div>
        </div>
        <div class="row-fluid">
          <div class="span5"><label>Response End Time</label></div>
          <div class="span3"><select id="ResponseEndTime" type="text" name="data[Response][end_time]"></select></div>
        </div>
        <div class="pull-left">
   			<a class="btn btn-primary" type="button" href="/uds/experiments/index">Go Back</a>
		</div>
		<div class="offset5">
    		<a class="btn btn-primary" type="button" onclick="$('#UploadForm').submit();return false;">Upload</a>
		</div>
        </form>
      </div>     
    </div>
  </div>
</div>

<script>
$("#getColumn").click(function() {
   	 $.ajax({
            type: 'POST',
            url: '<?php echo $this->Html->url(array("controller" => "uploads","action" => "getColumns"));?>',
            success:function(data){
            	$.each($.parseJSON(data), function(index, value) {   				
    				$("select").each(function(i) {
  						$(this).append('<option value="'+index+'">'+value+'</option>');
					});
				});
				$("select").each(function(i) {
  					$(this).append('<option selected="selected"></option>');
				});
            },
            error:function(){
            }
        });
});
</script>