<!DOCTYPE html>
<h3>Parking Ticket Price</h3>
<form action="index.php" method="post">
	<fieldset>

	<input id='action' type='hidden' name='action' value='updateParkingPrice'>
		<p>
			Price (per Hour)
			<input type='range' id='parkingPrice' min="50" max="500" step='10' value="50" id="fader" step="1" oninput='outputUpdate(value)' name='parkingPrice'>
		</p>
		Current Value(Cent): 
		<output for='parkingPrice' id='volume'></output>
	</fieldset>
	<button type='submit' class='btn btn-warning'>Submit</button>
</form>
<script>
function outputUpdate(vol) {
	document.querySelector('#volume').value = vol;
}
</script>