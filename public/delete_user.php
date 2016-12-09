<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection_open.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
	$user = find_user_by_id($_GET["id"]);
	if (!$user) {
		// user ID was missing or invalid or 
		// user couldn't be found in database
		redirect_to("manage_users.php");
	}
	
	$id = $user["id"];
	$sql = "DELETE FROM users WHERE id = :id LIMIT 1";
	try
	{
		// is preparing / sanitizing the SQL query required for DELETE? the ID value comes from us, not the user... or can the user enter another value for ID via $_GET with URL parameters?
		$statement = $db->prepare($sql);
		$statement->bindParam(":id", $id);
		$result = $statement->execute();
		$user_count = $statement->fetchColumn();
	}
	catch (PDOException $error)
	{
		echo "ERROR: " . $error->getMessage();
	}

	// if ($result && mysqli_affected_rows($connection) == 1) {
	// if ($result && $result->rowCount() == 1) {
	// if ($result && $user_count == 1) {
	if ($result) {
		// success
		$_SESSION["message"] = "user deleted.";
		redirect_to("manage_users.php");
	} else {
		// failure
		$_SESSION["message"] = "user deletion failed.";
		redirect_to("manage_users.php");
	}
?>

<?php 
	require_once("../includes/db_connection_close.php"); 
?>