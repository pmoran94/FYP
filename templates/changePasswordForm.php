<!DOCTYPE html>
<form class="navbar-form navbar-right" role="form" method="post"
	action="index.php" autocomplete="off">
	<h2>Change Password</h2>
	<div class="form-group">
		<input id='action' type='hidden' name='action' value='changePasswordForm' /> 
		<br>

		<p>Please Enter Your Current Password.</p>
		<input type="password" id="currentPass" name="currentPass" maxlength="30" required class="form-control"
			placeholder="Current Password">
			<br><br>

		<p>Please Enter and Confirm Your New Password.	</p>
		<input type="password" id="newPassword" name="newPassword"
			maxlength="20" required class="form-control" placeholder="New Password">
			<br>
		<input type="password" id="confPassword" name="confPassword"
			maxlength="20" required class="form-control" placeholder="Confirm New Password">
			<br><br>
		<button type="submit" class="btn btn-success">Change Password</button>
	</div>
</form>
