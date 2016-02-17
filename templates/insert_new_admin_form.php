<!DOCTYPE html >

<h3>New Employee Registration</h3>
<p style="color:red">
Please fill in all fields.
</p>
<form action="index.php" method="post">
	<fieldset>
		<input id='action' type='hidden' name='action' value='insertNewAdmin' />
		<p>
			<label for="fFirstname">First Name</label> <input type="text"
				id="fFirstname" name="fFirstname" placeholder="First Name"
				maxlength="25" required />
		</p>
		<p>
			<label for="fSurname">Surname</label>
			<input type="text" id = "fSurname" name="fSurname" placeholder="Surname"
					maxlength="25" required />
		</p>
		<p>
			<label for="fDOB">Date Of Birth</label><input type="date"
				id="fDOB" name="fDOB" placeholder="D.O.B" required/>
		</p>
		<p>
			<label for="fMobile">Mobile</label> +353<input type="text"
				id="fMobile" name="fMobile" placeholder="Mobile" maxlength="9" required/>
		</p>
		<p>
			<label for="fAddr">Address</label> 
			<input type="text" id="fAddr" name="fAddr" placeholder="Address" maxlength="50" required />
		</p>
		<p>
			<label for="fEmail">Email</label> <input type="email"
				id="fEmail" name="fEmail" placeholder="Email"
				maxlength="50" required />
		</p>

		<p>
			<label for="fIs_Admin">Is Admin/Is Not Admin <text style="color:red">(Important*)</text> </label>
  			<input type="radio" name="fIs_Admin" value="yes">Yes
  			<br>
  			<input type="radio" name="fIs_Admin" value="no" checked>No
		</p>
		<p>
			<label for="fPin">Pin</label>
			<input name="fPin" id="fPin" type="password" maxlength="6" placeholder= "Pin" required/>
		</p>

		<p>
		<label for="fPinConf">Confirm Pin</label>
		<input type="password" onChange="keyup();" name="fPinConf" id="fPinConf" maxlength="6"  placeholder = "Confirm Pin"/> 

		<p id='message'></p>
    	</p>

    	<script>
			$('#fPinConf').on('keyup', function () {
			    if ($(this).val() == $('#fPin').val()) {
			        $('#message').html('matching').css('color', 'green');
			    } else $('#message').html('not matching').css('color', 'red');
			});

    	</script>



		<p>
		<br>
		<div class="form-group">
			<div class="controls">
				<button type="submit" class="btn btn-success">Register Employee</button>
			</div>
		</div>
		</p>
	</fieldset>
</form>