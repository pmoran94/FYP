<h2 class="algerian" style="color:#fbb83a">Top Up Parking Ticket</h2>
<form action="index.php" method="post">
	<fieldset>
		<input id='action' type='hidden' name='action' value='topUpParkingTicket' /> 

		<label for='topUpChoice'></label>
		How would you like to Top Up your ticket?<br> 
		(By)<br><br>
			<table>
				<tr>	
					<td>Duration&nbsp&nbsp&nbsp</td>
					<td><input type='radio' name='topUpUsing' value='1' checked ></td>
				</tr>
				<tr>
					<td>Amount&nbsp&nbsp&nbsp</td>
					<td><input type='radio' name='topUpUsing' value='2'></td>
				</tr>
			</table>
			<hr>
			<br>
			<div id='topup-1' class="toHide" style='display:none;'>
				<label for=""></label>
					<select name=duration>
						<option value=halfHour>Half Hour</option>
						<option value=hour>1 Hour</option>
						<option value=hourHalf>1.5 Hours</option>
						<option value=twoHour>2 Hours</option>
						<option value=twoHourHalf>2.5 Hours</option>
						<option value=threeHour>3 Hours</option>
						<option value=four>4 Hours</option>
						<option value=five>5 Hours</option>
						<option value=six>6 Hours</option>
						<option value=seven>7 Hours</option>
						<option value=eight>8 Hours</option>
						<option value=nine>9 Hours</option>
						<option value=ten>10 Hours</option>
						<option value=eleven>11 Hours</option>
						<option value=twelve>12 Hours</option>
					</select>
				
			</div>
			<div id='topup-2' class="toHide" style='display:none;'>
				<label for=""></label> <input type="text"
					id="amount" name="amount" placeholder="Enter Amount (xx.xx) - Provide Decimal Point" 
					maxlength="5"  style="height:40px;width:100%" />
				
			</div>

	
		
		<p>
		<div class="form-group">
			<div class="controls">
				<button type="submit" class="btn btn-warning" style="color:grey">Next</button>
			</div>
		</div>
		</p>
	</fieldset>
</form>
<script type="text/javascript">
	
	// select the relevant <input> elements, and using on() to bind a change event-handler:
$(function() {
    $("[name=topUpUsing]").click(function(){
            $('.toHide').hide();
            $("#topup-"+$(this).val()).show('slow');
    });
 });

</script>
