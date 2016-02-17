<?php



$result = $_SESSION['updateUserData'];



?>

<form action="index.php" method="post">
	<fieldset>
		<input id='action' type='hidden' name='action' value='updateUser' />
		<p>
			<label for="fFName">First Name: </label><input type="text" name="fFName" value="'<?php echo $result[fname]; ?>'"/> <br> 
		</p>
		<p>
			<label for="fSName">Surname: </label><input type="text" name="fSName" value="<?php echo $_SESSION[sname]; ?>" /> <br> 
		</p>
		<p>
			<label for="fMobile">Mobile: </label><input type="text" name="fMobile" value="<?php echo $result['cmobile']?>"/> <br> 
		</p>
		<p>
			<label for="fEmail">Email: </label><input type="text" name="fEmail" value="<?php echo $result['cemail']?>"/> <br> 
		</p>
		<p>
			<label for="fAddr">Address: </label><input type="text" name="fAddr" value="<?php echo $result['caddr']?>"/> <br> 
		</p>
	</fieldset>



<script language="javascript"> 
function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "show";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "hide";
	}
} 
</script>



	<a  href="javascript:toggle();" name="displayText"><button type="button" class="btn btn-primary">Update</button></a>



<!--<a id="displayText" href="javascript:toggle();">show</a> <== click Here-->

<div id="toggleText" style="display: none"> 
<legend>
<fieldset>

	<br>
	<p style="color:red"> Please Verify Your Password in Order to Update Your Details * </p>

		<input type="password" id="fPassword" name="fPassword"
			maxlength="20" required class="form-control" placeholder="Verify Password">

	<br>
	<button type="submit" class="btn btn-primary">Verify Password and Update</button>

</fieldset>
</legend>
</div>
</form>