<?php 


// WRITE QUERY TO CHECK IF THE INSERT WAS SUCCESSFUL
// IF NOT DISPLAY ERROR MESSAGE

$var = $_GET['buttonSubmit'];

$val= "";

if($var == 'submitStamp'){
	$val = 'test3bb0b41acaf53b41d9496897358f1316.png';
}
else if($var == 'submitParkTicket'){
	$val = 'test3bb0b41acaf53b41d9496897358f1316.png';
}

?>
<br>
<br>

<div id='hello'>
	<h3>Your QR code will be visible shortly.</h3>
	<br>

<h4>Generating QR Code...</h4>
</div>


<div id='qrcodeimg' style='display:none'>
	<img src='phpqrcode/temp/'<?php echo $val; ?> style='height:140px; width:140px; margin-left: auto; margin-right: auto; display: block' />
	<br>

	<p>
		<h3>To save your ticket...</h3>
		<h4>1). Right-Click on image.<br>2). Go to Save image as...<br>3). Choose where to save your file.</h4>
	</p> 

</div>

<script type="text/javascript">
	$(function() {
  		$("#hello").delay(6000).fadeOut();
  		$("#qrcodeimg").delay(7000).fadeIn();
	});
</script>