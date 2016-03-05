<!DOCTYPE html>

<h4>Report Issue</h4>
<form role="form" method="post"action="index.php">
		<input id='action' type='hidden' name='action' value='reportIssue' /> 
<input type="text" id="concerning" name="concerning" style="height:40px;width:100%" placeholder="Customer Name/Registration/PO"><br>
<input type="text" id="issueSubject" name="issueSubject" style="height:40px;width:100%" placeholder="Subject">
<br>
<label for="fDesc">Description:</label><br> 
	<input type="text" style="height:100px;width:100%" id="issueContent" name="issueContent" placeholder="Content"
		maxlength="200" required/>
<br>
	<button type="submit" name="issueForm" class="btn btn-warning">Report Issue</button>
</form>		