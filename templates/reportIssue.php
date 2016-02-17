<!DOCTYPE html>

<h4>Issue Report</h4>
<form role="form" method="post"action="index.php">
		<input id='action' type='hidden' name='action' value='reportIssue' /> 
<input type="text" id="issueSubject" name="issueSubject" width="100%" placeholder="Subject">
<br>
<label for="fDesc">Description:</label><br> 
	<input type="text"
		id="issueContent" name="issueContent" placeholder="Content"
		maxlength="25" style="height:40px;width:100%" required />
<br>
	<button type="submit" name="issueForm" class="btn btn-success">Report Issue</button>
</form>		