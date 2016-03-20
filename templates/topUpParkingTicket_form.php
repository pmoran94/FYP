<h2 class="algerian" style="color:#fbb83a">Top Up Parking Ticket</h2>
<form action="index.php" method="post">
	<fieldset>
		<input id='action' type='hidden' name='action' value='updateParkingTicket' /> 

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
			<div id='topup-1' class="toHide" style=''>
				<label for=""></label>
					<select name=duration>
						<option value=30>Half Hour</option>
						<option value=60>1 Hour</option>
						<option value=90>1.5 Hours</option>
						<option value=120>2 Hours</option>
						<option value=150>2.5 Hours</option>
						<option value=180>3 Hours</option>
						<option value=240>4 Hours</option>
						<option value=300>5 Hours</option>
						<option value=360>6 Hours</option>
						<option value=420>7 Hours</option>
						<option value=480>8 Hours</option>
						<option value=540>9 Hours</option>
						<option value=600>10 Hours</option>
						<option value=660>11 Hours</option>
						<option value=720>12 Hours</option>
					</select>
				
			</div>
			<div id='topup-2' class="toHide" style='display:none;'>
				<lable for='amount'></lable>
				<p style='color:red'>
					Please Enter the value in the following format : 5.00, 10.50 etc.

				</p>
				<input type='number' step='any' name='amount' id='amount' style='height:40px' max=60 placeholder="Enter Amount (Max:60)">
					
			</div>

	
		
		<p>
		<div class="form-group">
			<div class="controls">
				<button type="submit" class="btn btn-warning" style="color:grey">Top Up</button>
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
