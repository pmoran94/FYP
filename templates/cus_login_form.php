<h2 class="algerian" style="color:#fbb83a">Login</h2>
<form action="index.php" method="post">
	<fieldset>
		<input id='action' type='hidden' name='action' value='loginUser' /> 
			<label for="fEmail"></label> <input type="text"
				id="fEmail" name="fEmail" placeholder="Email / Employee Number"
				maxlength="50"  style="height:40px;width:100%" required />
			
			<label for="fPassword"></label> <input type="password"
				id="fPassword" name="fPassword" placeholder="Password"
				maxlength="25" style="height:40px;width:100%" required />
		
	
		
		<p>
		<div class="form-group">
			<div class="controls">
				<button type="submit" class="btn btn-warning" style="color:grey">Login</button>
			</div>
		</div>
		</p>
	</fieldset>
</form>
