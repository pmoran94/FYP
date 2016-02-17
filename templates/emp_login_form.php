<!DOCTYPE html>
<h2>Admin Login</h2>
<form class="navbar-form navbar-right" role="form" method="post"
	action="index.php" autocomplete="off">
	<div class="form-group">
		<input id='action' type='hidden' name='action' value='loginAdmin' /> 
		<br>
		<input
			type="text" id="employeeNumber" name="employeeNumber" maxlength="30" required class="form-control"
			placeholder="Employee Number">
			<br>
		<input type="password" id="employeePin" name="employeePin" maxlength="20" required class="form-control" placeholder="PIN">
			<br>
		<button type="submit" class="btn btn-success">Login</button>
	</div>
	<div>
		<img src="./images/admin1.jpe" alt="Admin" style="background:rgba(255,255,255,0.1)">
	</div>
</form>
