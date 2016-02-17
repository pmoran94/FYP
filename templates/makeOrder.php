<!DOCTYPE html>

<h3>Make an Order</h3>
<fieldset>
<form role="form" method="post"action="index.php">
<input id='action' type='hidden' name='action' value='makeOrder' /> 
<p>Select what you would like to order</p><br>
<h4>Envelopes (7c Each)</h4>
<p>Quantity</p>
<select name="orderEnvs" >
<option value="100">100</option>
<option value="50">50</option>
<option value="25">25</option>
<option value="10">10</option>
<option value="0">0</option>
</select>
<br>
<h4>Stickers (2c Each)</h4>
<p>Quantity</p>
<select name="orderStickers">
<option value="100">100</option>
<option value="50">50</option>
<option value="25">25</option>
<option value="10">10</option>
<option value="0">0</option>
</select>
<br>

<br>


<script language="javascript"> 
function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "show";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "hide";
	}
} 
</script>



	<a  href="javascript:toggle();" name="displayText"><button type="button" class="btn btn-primary">Continue Order</button></a>



<!--<a id="displayText" href="javascript:toggle();">show</a> <== click Here-->

<div id="toggleText" style="display: none"> 
<legend>
<fieldset>

	<br>
	<p style="color:red"> Please Verify Your Password to Proceed with Order</p>

		<input type="password" id="fPassword" name="fPassword"
			maxlength="20" required class="form-control" placeholder="Verify Password">

	<br>
	<button type="submit" class="btn btn-primary">Verify Password and Order</button>

</fieldset>
</legend>
</div>
</form>		