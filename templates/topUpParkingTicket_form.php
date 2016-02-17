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
				<label for=""></label> <input type="number"
					id="duration" name="duration" placeholder="Enter no. of Hours"
					max='24' min='.5' style="height:40px;width:100%" />
				
			</div>
			<div id='topup-2' class="toHide" style='display:none;'>
				<label for=""></label> <input type="text"
					id="amount" name="amount" placeholder="Enter Amount (xx.xx)"
					maxlength="50"  style="height:40px;width:100%" />
				
			</div>

	
		
		<p>
		<div class="form-group">
			<div class="controls">
				<button type="submit" class="btn btn-warning" style="color:grey">Login</button>
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
