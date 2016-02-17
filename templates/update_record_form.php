<h3 style="color:white">Update Movie by ID</h3>
<form action="index.php" method="post">
	<fieldset>
		<input id='action' type='hidden' name='action' value='updateRecord' />
		<p>
			<label for="fID">Enter Movie ID:</label> <input type="number"
				id="fID" name="fID" placeholder="Movie ID"
			required />
		</p>
		<p>
			<label for="fMovie">Movie Name:</label> <input type="text"
				id="fMovie" name="fMovie" placeholder="New Movie Name"
				maxlength="25" required />
		</p>
		<p>
			<label for="fDesc">Description:</label> <input type="text"
				id="fDesc" name="fDesc" placeholder="New Description"
				maxlength="25" required />
		</p>
		<p>
			<label for="fRate">Rating:(Out of 10)</label> <input type="number"
				id="fRate" name="fRate" placeholder="New Rating"
				min="0" max="10" required />
		</p>
		
		<p>
		<div class="form-group">
			<div class="controls">
				<button type="submit" class="btn btn-success">Update</button>
			</div>
		</div>
		</p>
	</fieldset>
</form>