<h2>Delete Movie</h2>
<h4>Enter ID of Movie to Delete.</h4>
<form action="index.php" method="post">
	<fieldset>
		<input id='action' type='hidden' name='action' value='deleteRecord' />
		<p>
				Movie Track: <input type="number" id="movie" name="movie" min=0 placeholder="Movie ID" maxlength="25"  />
		</p>
		<p>
		<div class="form-group">
			<div class="controls">
				<button type="submit" class="btn btn-success">Delete</button>
			</div>
		</div>
		</p>
	</fieldset>
</form>