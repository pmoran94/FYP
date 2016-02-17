
<?php
echo "<html>";
echo "<head>";
echo "</head>";
echo "<body>";
echo "<form method='post'>";
echo "<button type='submit' name='submit' id='submit'>Submit</button> ";
echo "</form>";
echo "</body>";
echo "</html>";

if(isset($_POST['submit'])){

	$message = "You are invited to my event!";
	$subject = "Event invite!";
	//$email = $parameters['emails'];

	$message = str_replace("\n.", "\n..", $message);
	$wrappedmessage = wordwrap($message, 70, "\r\n");

	mail('pmoran946@gmail.com','Event invite!',$wrappedmessage);
	ini_set('display_errors','1');
}
?>