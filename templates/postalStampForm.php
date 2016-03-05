<html>
<head>
</head>
<form action="index.php" class="ws-validate" method="post">

	<fieldset>
		<input id='action' type='hidden' name='action' value='createPostStamp' /> 

			<table>	
				<tr>
					<td>
						<label for="destination">Destination</label>
							<select name="destination" required>
								<option value="Ireland">Ireland&NI</option>
								<option value="GB">Great Britain</option>
								<option value="Europe">Europe</option>
								<option value="Other">Rest of World</option>
							</select>
					</td>
					<td>
						<label for="weight">Weight</label>
							<select name="weight" required>
								<option value="100">100g</option>
								<option value="250">250g</option>
								<option value="500">500g</option>
								<option value="1kg">1KG</option>
								<option value="1.5kg">1.5KG</option>
								<option value="2kg">2KG</option>
								<option value="2.5kg">2.5KG</option>
								<option value="3kg">3KG</option>
								<option value="3.5kg">3.5KG</option>
								<option value="4kg">4KG</option>
								<option value="4.5kg">4.5KG</option>
								<option value="5kg">5KG</option>
							</select>
					</td>
					<td>
						<label for="type">Post Type</label>
							<select name="type" required>
								<option value="letter">Letter/Postcard</option>
								<option value="largeEnv">Large Env.</option>
								<option value="packet">Packet</option>
								<option value="parcel">Parcel</option>
							</select>
					</td>
				</tr>

			</table>


		<p>
		<div class="form-group">
			<div class="controls">
				<a href="javascript:toggle();" name="displayText"><button type="button" id='prompt'  class="btn btn-warning" style="color:grey">Next</button></a>
			</div>
		</div>
		</p>
		<div id="toggleText" style="display: none"> 
		<legend>
		<fieldset>

			<br>
			<p style="color:red">Confirm Password</p>

				<input type="password" id="fPassword" name="fPassword"
					maxlength="20" style="height:40px;width:100%"  required class="form-control" placeholder="Verify Password">

			<br>
			<button type="submit" class="btn btn-primary" name="submitStamp" >Confirm</button></a>

		</fieldset>
		</legend>
		</div>
	</fieldset>
</form>
</html>




<script src="bootbox.min.js"></script>
<script>

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

	//<a href="javascript:toggle();" name="displayText">

	/*

	$(document).on("click", "#prompt", function(e) {
        bootbox.prompt("What is your name?", function(result) {                
		if (result === null) {                                             
			Example.show("Prompt dismissed");                              
		} else {
		    Example.show("Hi <b>"+result+"</b>");                          
		}
		})
    });*/
	
</script>

