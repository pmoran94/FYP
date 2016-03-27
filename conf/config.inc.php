<?php
/*
Assigning some fixed values which will be used throughout the whole application
*/
/* database constants */
//define("DB_HOST", "us-cdbr-iron-east-03.cleardb.net" ); 		
//define("DB_USER", "be0b95871569" ); 			
//define("DB_PASS", "c40019f3" ); 		
//define("DB_PORT", 3306);				
//define("DB_NAME", "heroku_6192e1613c2ebd9" ); 		

define("DB_HOST", "localhost" ); 		
define("DB_USER", "root" ); 			
define("DB_PASS", "" ); 		
define("DB_PORT", 3306);				
define("DB_NAME", "fyp" );

/* application constants */
define("APP_NAME", "Online QR System" ); 		
/* new user form constants */
define("NEW_USER_FORM_ERRORS_STR", "Errors exist in the form");
define("NEW_USER_FORM_ERRORS_COMPULSORY_STR", "All the fields are compulsory");
define("NEW_USER_FORM_ERRORS_PWMISMATCH", "Passwords did not match!");
define("NEW_USER_FORM_ERRORS_CUS_DELETEMISMATCH", "The Email and PO Number did not match!");
define("NEW_USER_FORM_EXISTING_ERROR_STR", "Another user already exists in the system with the same username");
define("NEW_USER_FORM_MAX_USERNAME_LENGTH", 25);	
define("NEW_USER_FORM_MAX_PASSWORD_LENGTH", 20); 
define("MAX_LENGTH_FOR_MOBILE", 9);
define("NEW_PONUMBER_LENGTH",7);
define("NEW_USER_FORM_REGISTRATION_CONFIRMATION_STR", "You have registered successfully, Please Log In");
define("NEW_USER_FORM_SYSTEM_ERROR_STR", "Something went wrong during registration");
define("NON_LOGGED_IN_USER_STR","Records may not be altered with by User's Who are not logged in!");
define("NON_LOGGED_IN_USER_STR_USERS","You must be logged in to update your account!");
define("DELETE_CURRENT_USER_SUCCESS","You have successfully been removed from our records.");


/* login user form constants */
define("LOGIN_USER_FORM_MAX_USERNAME_LENGTH", 30);	
define("LOGIN_USER_FORM_MAX_PASSWORD_LENGTH", 20); 
define("MAX_LENGTH_FOR_EMP_NO",6);
define("MAX_LENGTH_FOR_EMP_PIN",6);
define("MIN_LENGTH_FOR_EMP_PIN",4);	
define("LOGIN_USER_FORM_WELCOME_STR", "Welcome");
define("LOGIN_USER_FORM_AUTHENTICATION_ERROR", "Incorrect Details");
define("LOGIN_USER_FORM_LOGOUT_STR", "Logout");

/* misc */
define("INDEX_INTRO_MESSAGE_STR", " " . APP_NAME . " ");
define("LOGGED_IN_USER_MENU", "<ul><li>option 1</li><li>option 2 </li></li>");
define("USER_NOT_LOGGED_IN","Records may not be altered with by User's who are not logged in.");
?>