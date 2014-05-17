<div id="result">

</div>
<script>
if(typeof(EventSource)!=="undefined"){
  var source=new EventSource('<?php echo $this->Html->url(array("controller" => "uploads","action" => "sse"));?>');
  source.onmessage=function(event){
    document.getElementById("result").innerHTML+=event.data + "<br>";
  };
}
else {
  document.getElementById("result").innerHTML="Sorry, your browser does not support server-sent events...";
}
</script>