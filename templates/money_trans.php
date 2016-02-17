<!DOCTYPE html>

<div id="money_trans" style="background-color:">
	<h3>Top Up Account</h3>
	<form role="form" method="post"action="index.php">
	<input id='action' type='hidden' name='action' value='transferMoney' /> 
		<fieldset>
			<legend>
			<p>
				<label for="nameOnCard">Name On Card: </label> 
				<input type="text"	id="nameOnCard" name="nameOnCard" placeholder="Card Holder"  />
			</p>
			<p>
				<label for="cardNumber">Card Number: </label>
				<input type="text" id="cardNumber" name="cardNumber" placeholder="Card Number"/>
			</p>
			<p>
				<label for="cardNumber">CVV Number: </label>
				<input type="text" id="cvv" name="cvv" placeholder="CVV Number"/>
			</p>
			<p>
				<label for="cardNumber">Card Expiry Date: </label>
				<input type="text" id="expiryDate" name="expiryDate" placeholder="Expiry Date"/>
			</p>
		</fieldset>
	</legend>
</div>

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



	<a  href="javascript:toggle();" name="displayText"><button type="button" class="btn btn-primary">Next Step</button></a>



<!--<a id="displayText" href="javascript:toggle();">show</a> <== click Here-->

<div id="toggleText" style="display: none"> 
<legend>
<fieldset>

	<br>
	<p style="color:red"> Confirm Log In Details</p>

		<input type="email" id="fEmail" name="fEmail"
			maxlength="20" required class="form-control" placeholder="Email">	
		<input type="password" id="fPassword" name="fPassword"
			maxlength="20" required class="form-control" placeholder="Password">

	<br>
	<button type="submit" class="btn btn-primary">Verify Money Transfer</button>

</fieldset>
</legend>
</div>
</form>		