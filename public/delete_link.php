<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection_open.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
	$current_link = find_link_by_id($_GET["link"], false);
	if (!$current_link) {
		// link ID was missing or invalid or 
		// link couldn't be found in database
		redirect_to("manage_content.php");
	}
	
	$id = $current_link["id"];
	$sql = "DELETE FROM links WHERE id = :id LIMIT 1";
	try
	{
		// is preparing / sanitizing the SQL query required for DELETE? the ID value comes from us, not the user... or can the user enter another value for ID via $_GET with URL parameters?
		$statement = $db->prepare($sql);
		$statement->bindParam(":id", $id);
		$result = $statement->execute();
		$link_count = $statement->fetchColumn();
	}
	catch (PDOException $error)
	{
		echo "ERROR: " . $error->getMessage();
	}

	// if ($result && mysqli_affected_rows($connection) == 1) {
	// if ($result && $result->rowCount() == 1) {
	// if ($result && $link_count == 1) {
	if ($result) {
		// success
		$_SESSION["message"] = "link deleted.";
		redirect_to("manage_content.php");
	} else {
		// failure
		$_SESSION["message"] = "link deletion failed.";
		redirect_to("manage_content.php?link={$id}");
	}
?>

<?php 
	require_once("../includes/db_connection_close.php"); 
?>