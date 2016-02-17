<!DOCTYPE html >

<h3>Delete Customer</h3>
<p style="color:red">


Customers PO Number and Email Must Match in order to be deleted.

</p>
<form action="index.php" method="post">
	<fieldset>
		<input id='action' type='hidden' name='action' value='deleteCustomer' />
		<p>
			<label for="fEmail">Enter Customers Email to delete : </label> 
			<input type="text"	id="fEmail" name="fEmail" placeholder="Email"  />
		</p>
		<p>
			<label for="fponumber">Enter Customers PO Number to delete : </label>
			<input type="text" id="fponumber" name="fponumber" placeholder="PO Number"/>
		</p>
	<button type="submit" class="btn btn-secondary">Delete </button>
	</fieldset>
</form>