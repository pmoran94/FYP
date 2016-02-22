<h2 class="algerian" style="color:#fbb83a">Who to Invite?</h2>
<form action="index.php" class="ws-validate" method="post">

	<fieldset>
		<input id='action' type='hidden' name='action' value='sendInvites' /> 

			<label for="nameOfEvent">Name Your Event</label>
				<input type="text" name="nameOfEvent" style="height:40px;width:100%" id="nameOfEvent" placeholder="Event Name:" maxlenght="20" required>
			<label for="descOfEvent">Event Description</label>
				<input type="textarea" name="descOfEvent" style="height:80px;width:100%" id="descOfEvent" placeholder="Description" maxlenght="200" required><br><br>

			<label for="dateOfEvent">Select a Date</label>
				<input type="datetime-local" name="dateOfEvent" style="height:40px;width:60%" id="dateOfEvent" required>

			<label for="eventLocation">Location</label>
				<input type="text" name="eventLocation" style="height:80px;width:100%" placeholder="Location" required>

			<label for="inviteType">Invite Type</label>
				<select name="inviteType" required>
					<option value="open">Open Invite</option>
					<option value="+one">+1's</option>
					<option value="strictlyInvite">Strictly Invite</option>
				</select>

			<label for="noOfInvites">How many people do you wish to invite?&nbsp&nbsp</label> <input type="number"
				id="noOfInvites" name="noOfInvites" 
				min='0' max='10'  style="height:40px;width:10%" required />

			
			<button type="button" class="btn btn-warning" name='next' style="color:grey">Next</button><br><br>


			<div id='emailAddresses'>
			<h3>Who to Invite?</h3>
			</div>
		
	
		
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
$(function() {
    $("[name=next]").click(function(){
            /*$('.toHide').hide();
            $("#topup-"+$(this).val()).show('slow');*/

        	var num = $( '#noOfInvites' ).val();

        	for(i=0;i<num;i++){
        		$('#emailAddresses').append("Email Address).: <input type='email' name='emails' style='height:20;width;50%'id='emails'>"+"<br>"); 
        	}

    });
 });

</script>
