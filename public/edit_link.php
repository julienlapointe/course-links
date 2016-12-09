<!-- same as link CREATE code, except need to bind link ID (to identify link to be UPDATED) and the form fields are pre-filled with existing values -->
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection_open.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/form_validation.php"); ?>
<?php confirm_logged_in(); ?>

<?php set_current_course_link(); ?>

<?php
	// unlike create_link.php, we don't need a course_id to be sent
	// we already have it stored in links.course_id.
	if (!$current_link) {
		// link ID was missing or invalid or 
		// link couldn't be found in database
		redirect_to("manage_content.php");
	}
?>

<?php
if (isset($_POST['submit'])) {
	
	$url = $_POST["url"];
	$title = $_POST["title"];
	$course_id = (int) $_POST["course_id"];
	$position = (int) $_POST["position"];
	$visible = (int) $_POST["visible"];
	$id = $current_link["id"];

	// validations
	// $required_fields = array("url", "title", "course_id", "position", "visible");
	$required_fields = array($_POST["url"], $_POST["title"], $_POST["course_id"], $_POST["position"], $_POST["visible"]);
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("url" => 2083);
	validate_max_lengths($fields_with_max_lengths);

	$fields_with_max_lengths = array("title" => 500);
	validate_max_lengths($fields_with_max_lengths);
	
	if (empty($errors)) {
		
		// UPDATE

		$sql  = "UPDATE links SET ";
		$sql .= "url = ?, ";
		$sql .= "title = ?, ";
		$sql .= "course_id = ?, ";
		$sql .= "position = ?, ";
		$sql .= "visible = ? ";
		$sql .= "WHERE id = ? ";
		$sql .= "LIMIT 1";
		// use the line below for debugging SQL queries
		// die(mysqli_error($connection));
		try
		{
			$statement = $db->prepare($sql);
			$bindParamArray = array($url, $title, $course_id, $position, $visible, $id);
			$result = $statement->execute($bindParamArray);
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}
		
		// $result will only be 0 / FALSE if there is an error with my query (ex. misplaced comma); $result will hold a value even if no records are found / affected
		// if ($result || mysqli_affected_rows($connection) == 1) {
		if ($result || $result->rowCount() == 1) {
			// Success
			$_SESSION["message"] = "link updated.";
			redirect_to("manage_content.php?link={$id}");
		} else {
			// Failure
			$_SESSION["message"] = "link update failed.";
		}
	
	}
} 	

?>

<?php $user_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		
		<h2>Edit link: <?php echo htmlentities($current_link["title"]); ?></h2>
		<form action="edit_link.php?link=<?php echo urlencode($current_link["id"]); ?>" method="post">
			<p>URL:
				<input type="text" name="url" value="<?php echo htmlentities($current_link["url"]); ?>" />
			</p>
			<p>Title:
				<input type="text" name="title" value="<?php echo htmlentities($current_link["title"]); ?>" />
			</p>
			<p>Course:
				<select name="course_id">
				<?php
					// $course_set = find_all_courses(true);
					// $course_count = $course_set->rowCount();
					$course_set = $db->query('SELECT * FROM courses');
				    // $course_count = $course_set->fetchColumn();
					// for($count=1; $count <= $course_count; $count++) {
					foreach($course_set as $course)
					{
						echo "<option value=\"{$course["id"]}\"";
						if ($current_link["course_id"] == $course["id"]) {
							echo " selected";
						}
						echo ">{$course["name"]}</option>";
					} ?>
				</select>
			</p>
			<p>Position:
				<select name="position">
				<?php
					// NOTE TO SELF: added "course_id" column to "links" table instead; this is an easier solution / simpler structure --> previous comment: course_id" column does not exist in "links" table; must create new table called "link_course" that matches "id" from "links" table to "id" from "courses" table
					// $link_set = find_links_for_course($current_link["course_id"], false);
					// $link_count = $link_set->rowCount();
					$course_id = $current_link["course_id"];
					$sql = "SELECT COUNT(*) FROM links WHERE course_id = :course_id";
					$statement = $db->prepare($sql);
					$statement->bindParam(":course_id", $course_id);
					$statement->execute();
				    $link_count = $statement->fetchColumn();

					for($count=1; $count <= $link_count; $count++) {
						echo "<option value=\"{$count}\"";
						if ($current_link["position"] == $count) {
							echo " selected";
						}
						echo ">{$count}</option>";
					}
				?>
				</select>
			</p>
			<p>Visible to guest users:
				<input type="radio" name="visible" value="0" <?php if ($current_link["visible"] == 0) { echo "checked"; } ?> /> No
				&nbsp;
				<input type="radio" name="visible" value="1" <?php if ($current_link["visible"] == 1) { echo "checked"; } ?>/> Yes
			</p>
			<input type="submit" name="submit" value="Edit link" />
		</form>
		<br />
		<a href="manage_content.php?link=<?php echo urlencode($current_link["id"]); ?>">&laquo; Back</a>
		&nbsp;
		&nbsp;
		<a href="delete_link.php?link=<?php echo urlencode($current_link["id"]); ?>" onclick="return confirm('Are you sure?');">x Delete link</a>
		
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
<?php 
	require_once("../includes/db_connection_close.php"); 
?>