<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php

	$_SESSION["PRN"] = null;
	session_destroy();
	Redirect_to("sign_in.php");

?>
