<?php


//Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;
//Instantiate the client.
$mgClient = new Mailgun('key-7d9e8452dc7c8572bbe7772e8c9fb33d');
$domain = "sandbox7d574f341db64f76b610db430023b87e.mailgun.org";
//Make the call to the client.
$result = $mgClient->sendMessage($domain, array(
    'from'    => 'Excited User <mailgun@sandbox7d574f341db64f76b610db430023b87e.mailgun.org>',
    'to'      => 'Paul <cillinlyons@outlook.com>',
    'subject' => 'Event Invitation',
    'text'    => 'You have been invited to an event created by <USER>! 
    on the <TIMEDATE> at the <ADDRESS>!
    Here is you Invitation Pass!',
    
));


?>