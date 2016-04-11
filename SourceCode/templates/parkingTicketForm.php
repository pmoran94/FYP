<form action="index.php" class="ws-validate" method="post">

	<fieldset>
		<input id='action' type='hidden' name='action' value='createCarTicket' /> 

		<label for="definedExpiry">Do you wish to set an expected expiry date/time? </label>
			<input type="datetime-local" style="height:40px" name="expiryTime" placeholder="Expiry Time"?


		<p>
		<div class="form-group">
			<div class="controls">
				<a href="javascript:toggle();" name="displayText"><button type="button"  class="btn btn-warning" style="color:grey">Next</button></a>
			</div>
		</div>
		</p>
		<div id="toggleText" style="display: none"> 
		<legend>
		<fieldset>

			<br>
			<p style="color:red">Confirm Password</p>

				<input type="password" id="fPassword" name="fPassword"
					maxlength="20" style="height:40px;width:100%" required class="form-control" placeholder="Verify Password">

			<br>
			<button type="submit" class="btn btn-primary" name="submitCPark" >Confirm</button>

		</fieldset>
		</legend>
		</div>
	</fieldset>
</form>
<script type="text/javascript">

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

