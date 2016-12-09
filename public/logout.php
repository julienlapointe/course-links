<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
	// session_start();
	$_SESSION["user_id"] = null;
	$_SESSION["username"] = null;
	$_SESSION["user_type"] = null;
	redirect_to("login.php");
?>
