<!DOCTYPE html >

<h3>Add New Employee</h3>
<p style="color:red">
Please fill in all fields.
</p>
<form action="index.php" method="post">
	<fieldset>
		<input id='action' type='hidden' name='action' value='insertNewEmployee' />
		<p>
			<label for="fFirstname">First Name</label> <input type="text"
				id="fFirstname" name="fFirstname" placeholder="First Name"
				maxlength="25" style="height:40px;width:100%" required />
		</p>
		<p>
			<label for="fSurname">Surname</label>
			<input type="text" id = "fSurname" name="fSurname" placeholder="Surname"
					maxlength="25" style="height:40px;width:100%" required />
		</p>
		<p>
			<label for="fDOB">Date Of Birth</label><input type="date"
				id="fDOB" name="fDOB" placeholder="D.O.B" style="height:40px;width:100%" required/>
		</p>
		<p>
			<label for="fMobile">Mobile</label> +353<input type="text"
				id="fMobile" name="fMobile" maxlength="9" style="height:40px;width:100%" placeholder="Mobile" required/>
		</p>
		<p>
			<label for="fAddr">Address</label> 
			<input type="textarea" id="fAddr" name="fAddr" style="height:80px;width:100%" placeholder="Address" maxlength="50" required />
		</p>
		<p>
			<label for="fEmail">Email</label> <input type="email"
				id="fEmail" name="fEmail" placeholder="Email"
				maxlength="50" style="height:40px;width:100%" required />
		</p>
		<p>	
			<label for="fCompanyName">Company Name:</label>
			<input type='text' name='fCompanyName' maxlenght='50' placeholder="Company Name" style="height:40px;width:100%" required>
		</p>
		<p>
			<label for="fCompanyService">Provided Service</label>
			<select type='radio' name='fCompanyService'>
				<option value='stamp'>Postal Service</option>
				<option value='cpark'>Car Park Service</option>
				<option value='event'>Event Staff</option>
			</select>
		</p>
		<p>
			<label for="fPassword">Pin Number</label>
			<input name="fPassword" id="fPassword" type="password"  maxlength="6" placeholder= "Password" style="height:40px;width:100%" required/>
		</p>

		<p>
		<label for="fPassConf">Confirm Pin</label>
		<input type="password" onChange="keyup();" name="fPassConf" id="fPassConf" maxlength="6" placeholder = "Confirm Password" style="height:40px;width:100%" required/> 

		<p id='message'></p>
    	</p>

    	<script type="text/javascript">
			$('#fPassConf').on('keyup', function () {
			    if ($(this).val() == $('#fPassword').val()) {
			        $('#message').html('matching').css('color', 'green');
			    } else $('#message').html('not matching').css('color', 'red');
			});

    	</script>



		<p>
		<br>
		<div class="form-group">
			<div class="controls">
				<button type="submit" class="btn btn-success">Sign up</button>
			</div>
		</div>
		</p>
	</fieldset>
</form>