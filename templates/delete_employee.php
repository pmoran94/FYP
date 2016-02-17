<!DOCTYPE html >

<h3>Delete Employee</h3>
<p style="color:red">

Delete employee by Employee Number or Employee Name.

</p>
<form action="index.php" method="post">
	<fieldset>
		<input id='action' type='hidden' name='action' value='deleteEmployee' />
		<p>
			<label for="empNum">Enter Employee Number to delete : </label> 
			<input type="text"	id="empNum" name="empNum" placeholder="Employee Number"  />
		</p>
	</fieldset>
	
		<br>
	
		<p>or</p>
	
		<br>
	<fieldset>
		<input id='action' type='hidden' name='action' value='deleteEmployee'/>
		<p>
			<label for="empName">Enter Full Name of Employee to delete : </label>
			<input type="text" id="empName" name="empName" placeholder="Employee Name"/>
		</p>
	<button type="submit" class="btn btn-secondary">Delete</button>
	</fieldset>
</form>