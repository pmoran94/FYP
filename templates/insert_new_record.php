<h3>Add New Movie</h3>
<h4>Add a new Movie , Description and Rating</h4>
<form action="index.php" method="post">
	<fieldset>
		<input id='action' type='hidden' name='action' value='insertNewRecord' />
		<p>
			<label for="fMovie">Movie Name:</label> <input type="text"
				id="fMovie" name="fMovie" placeholder="moviename"
				maxlength="25" required />
		</p>
		<p>
			<label for="fDesc">Description:</label> <input type="text"
				id="fDesc" name="fDesc" placeholder="description"
				maxlength="25" required />
		</p>
		<p>
			<label for="fRate">Rating:(Out of 10)</label> <input type="number"
				id="fRate" name="fRate" placeholder="rating" min="0" max="10" required />
		</p>
		
		<p>
		<div class="form-group">
			<div class="controls">
				<button type="submit" class="btn btn-success">Add New</button>
			</div>
		</div>
		</p>
	</fieldset>
</form>