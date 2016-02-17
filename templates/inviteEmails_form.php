<h2 class="algerian" style="color:#fbb83a">Who to Invite?</h2>
<form action="index.php" method="post">
	<fieldset>
		<input id='action' type='hidden' name='action' value='sendInvites' /> 

			<label for="noOfInvites">How many people do you wish to invite?&nbsp&nbsp</label> <input type="number"
				id="noOfInvites" name="noOfInvites" 
				min='0' max='10'  style="height:40px;width:10%" required />

			
			<button type="button" class="btn btn-warning" name='next' style="color:grey">Next</button><br><br>

			<div id='emailAddresses'>
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
