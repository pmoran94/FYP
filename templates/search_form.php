<form action="index.php" method="post">
	<fieldset>
		<input id='action' type='hidden' name='action' value='searchCustomers' />
		<p>
			<label for="search"></label> <input type="text"
				id="search" name="searchValue" placeholder="Search"
				maxlength="25" required />
		</p>
		
		<p>
		<div class="form-group">
			<div class="controls">
				<button type="submit" class="btn btn-success">Search</button>
			</div>
		</div>
		</p>
	</fieldset>
</form>