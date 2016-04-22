<!DOCTYPE html>
<form class="navbar-form" role="form" method="post"
	action="index.php" autocomplete="off">
	<h2>Change Pin</h2>
	<div class="form-group">
		<input id='action' type='hidden' name='action' value='changePinForm' /> 
		<br>

		<p>Please Enter Your Current Pin.</p>
		<input type="password" id="currentPin" name="currentPin" maxlength="6" required class="form-control"
			placeholder="Current Pin" style="height:40px;width:100%">
			<br><br>

		<p>Please Enter and Confirm Your New Pin.	</p>
		<input type="password" id="newPin" name="newPin"
			maxlength="6" required class="form-control" placeholder="New Pin" style="height:40px;width:100%">
			<br>
		<input type="password" id="confPin" name="confPin"
			maxlength="6" required class="form-control" placeholder="Confirm New Pin" style="height:40px;width:100%">
			<br><br>
		<button type="submit" class="btn btn-warning">Change Pin</button>
	</div>
</form>
