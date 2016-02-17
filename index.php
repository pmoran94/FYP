<?php
/* creates a session or resumes the current one based on a session identifier passed via a GET or POST request, or passed via a cookie. The $_SESSION superglobal array can contain variable accessible accross the entire session */
session_start ();
/*
	The variable action is declared,and if valid login details are entered, they are assigned to the action variable.
*/
$action = "";
if (! empty ( $_REQUEST ['action'] ))
	$action = $_REQUEST ['action'];

/*
	The index includes each of the model controllers and views
*/
include "models/Model.php";
include "controllers/Controller.php";
include "views/View.php";
/*
	The index here, is assigned specific instances of each of the model view and controller.
	For instance , it assigns a regular instance of the model, an instance of the controller which contains the model and parameters and superglobal session variables,
	and the view which contains the controller and model.
	The view also calls its own method output for the display screen.
*/
$model = new Model ();
$controller = new Controller ( $model, $action, $_REQUEST );
$view = new View ( $controller, $model );
$view->output ();
?>