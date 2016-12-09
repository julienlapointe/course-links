<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection_open.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
	$current_course = find_course_by_id($_GET["course"], false);
	if (!$current_course) {
		// course ID was missing or invalid or 
		// course couldn't be found in database
		redirect_to("manage_content.php");
	}
	
	$link_set = find_links_for_course($current_course["id"], $user_context);
	// NOTE TO SELF: I don't think the line below is going to work... calculate $statement->rowCount() inside find_links_for_cateogry() and return it as a result?
	// if ($links_set->rowCount() > 0) {
	// this is kind of hack...
	$link_count=0;
	foreach($link_set as $row)
	{
		$link_count += 1;
	}
	if ($link_count > 0) {
		$_SESSION["message"] = "Can't delete a course with links. Please delete all links first.";
		redirect_to("manage_content.php?course={$current_course["id"]}");
	}
	
	$id = $current_course["id"];
	$sql = "DELETE FROM courses WHERE id = :id LIMIT 1";
	try
	{
		// is preparing / sanitizing the SQL query required for DELETE? the ID value comes from us, not the user... or can the user enter another value for ID via $_GET with URL parameters?
		$statement = $db->prepare($sql);
		$statement->bindParam(":id", $id);
		$result = $statement->execute();
		$course_count = $statement->fetchColumn();
	}
	catch (PDOException $error)
	{
		echo "ERROR: " . $error->getMessage();
	}

	// if ($result && $course_count == 1) {
	if ($result) {
		// success
		$_SESSION["message"] = "course deleted.";
		redirect_to("manage_content.php");
	} else {
		// failure
		$_SESSION["message"] = "course deletion failed.";
		redirect_to("manage_content.php?course={$id}");
	}
?>

<?php 
	require_once("../includes/db_connection_close.php"); 
?>