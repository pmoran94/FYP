<!DOCTYPE html>
<h2>Change Pin</h2>
<form class="navbar-form navbar-right" role="form" method="post"
	action="index.php" autocomplete="off">
	<div class="form-group">
		<input id='action' type='hidden' name='action' value='changePinForm' /> 
		<br>

		<p>Please Enter Your Current Pin.</p>
		<input type="password" id="currentPin" name="currentPin" maxlength="30" required class="form-control"
			placeholder="Current Pin">
			<br><br>

		<p>Please Enter and Confirm Your New Pin.	</p>
		<input type="password" id="newPin" name="newPin"
			maxlength="20" required class="form-control" placeholder="New Pin">
			<br>
		<input type="password" id="confPin" name="confPin"
			maxlength="20" required class="form-control" placeholder="Confirm New Pin">
			<br><br>
		<button type="submit" class="btn btn-success">Change Pin</button>
	</div>
</form>
