<!DOCTYPE html>
<h3>Contact User</h3>
<form role="form" method="post"action="index.php">
	<input type='hidden' name='ponumber' value=''    /> 
	<input id='action' type='hidden' name='action' value='contactCustomerByNotification' > 
<input type="text" id="contactSubject" name="contactSubject" style="height:40px;width:100%" placeholder="Subject">
<br>
<label for="fDesc"><h4>Description:</h4></label><br> 
	<input type="text" style="height:100px;width:100%" id="contactContent" name="contactContent" placeholder="Content"
		maxlength="200" required/>
<br>
	<button type="submit" name="contactForm" class="btn btn-warning">Send</button>
</form>		