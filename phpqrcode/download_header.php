<!DOCTYPE HTML>
<div id='hello'>
	<h3>Your QR code will be visible shortly.</h3>
	<br>

<h4>Generating QR Code...</h4>
</div>

<div id='qrcodeimg' style='display:none'>
	<?php
		
		$PNG_WEB_DIR = './phpqrcode/temp/';
		include_once './phpqrcode/temp/getLastCreatedPNG.php';
		
	?>

	<img src='./phpqrcode/temp/228924549feaae4c4b229ca343e639b82edbb76.png' style=height:140px;width:140px;margin-left:auto;margin-right:auto;display:block> ;
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