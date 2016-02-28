<form action="index.php" class="ws-validate" method="post">

	<fieldset>
		<input id='action' type='hidden' name='action' value='createPostStamp' /> 

			<table>	
				<tr>
					<td>
						<label for="destination">Destination</label>
							<select name="destination" required>
								<option value="Zone1">Ireland&NI</option>
								<option value="Zone2">Great Britain</option>
								<option value="Zone3">Europe</option>
								<option value="Zone4">Rest of World</option>
							</select>
					</td>
					<td>
						<label for="weight">Weight</label>
							<select name="weight" required>
								<option value="100">100g</option>
								<option value="250">250g</option>
								<option value="500">500g</option>
								<option value="1kg">1KG</option>
								<option value="1.5kg">1.5KG</option>
								<option value="2kg">2KG</option>
								<option value="2.5kg">2.5KG</option>
								<option value="3kg">3KG</option>
								<option value="3.5kg">3.5KG</option>
								<option value="4kg">4KG</option>
								<option value="4.5kg">4.5KG</option>
								<option value="5kg">5KG</option>
							</select>
					</td>
					<td>
						<label for="type">Post Type</label>
							<select name="type" required>
								<option value="letter">Letter/Postcard</option>
								<option value="largeEnv">Large Env.</option>
								<option value="packet">Packet</option>
								<option value="parcel">Parcel</option>
							</select>
					</td>
				</tr>

			</table>


		<p>
		<div class="form-group">
			<div class="controls">
				<button type="submit" class="btn btn-warning" style="color:grey">Create</button>
			</div>
		</div>
		</p>
	</fieldset>
</form>
<script type="text/javascript">
	
	// select the relevant <input> elements, and using on() to bind a change event-handler:

</script>
