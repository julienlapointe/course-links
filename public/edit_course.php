<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection_open.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/form_validation.php"); ?>
<?php confirm_logged_in(); ?>

<?php set_current_course_link(); ?>

<?php
	if (!$current_course) {
		// course ID was missing or invalid or 
		// course couldn't be found in database
		redirect_to("manage_content.php");
	}
?>

<?php
if (isset($_POST['submit'])) {
	
	// validations
	// $required_fields = array("name", "position", "visible");
	$required_fields = array($_POST["name"], $_POST["position"], $_POST["visible"]);
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("name" => 30);
	validate_max_lengths($fields_with_max_lengths);
	
	if (empty($errors)) {
		
		// UPDATE

		$name = $_POST["name"];
		$position = (int) $_POST["position"];
		$visible = (int) $_POST["visible"];
		$id = $current_course["id"];
	
		$sql  = "UPDATE courses SET ";
		$sql .= "name = ?, ";
		$sql .= "position = ?, ";
		$sql .= "visible = ? ";
		$sql .= "WHERE id = ? ";
		$sql .= "LIMIT 1";
		
		try
		{
			$statement = $db->prepare($sql);
			// $statement->bindParam(":name", $name);
			// $statement->bindParam(":position", $position);
			// $statement->bindParam(":visible", $visible);
			$bindParamArray = array($name, $position, $visible, $id);
			// $result = $statement->execute();
			$result = $statement->execute($bindParamArray);
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}
		// NOTE TO SELF: is line below correct? other EDIT / UPDATE pages are "... == 0"
		if ($result || $statement->rowCount() >= 0) {
			// Success
			$_SESSION["message"] = "course updated.";
			redirect_to("manage_content.php");
		} else {
			// Failure
			$message = "course update failed.";
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
		<?php // $message is just a variable, doesn't use the SESSION
			if (!empty($message)) {
				echo "<div class=\"message\">" . htmlentities($message) . "</div>";
			}
		?>
		<?php echo form_errors($errors); ?>
		
		<h2>Edit course: <?php echo htmlentities($current_course["name"]); ?></h2>
		<form action="edit_course.php?course=<?php echo urlencode($current_course["id"]); ?>" method="post">
		  <p>Course name:
		    <input type="text" name="name" value="<?php echo htmlentities($current_course["name"]); ?>" />
		  </p>
		  <p>Position:
		    <select name="position">
				<?php
					// $course_set = find_all_courses(false);
					// $course_count = $course_set->rowCount();
					$sql = "SELECT COUNT(*) FROM courses";
					// prepare not needed here, but used it anyways for consistency
					$statement = $db->prepare($sql);
					$statement->execute();
				 	$course_count = $statement->fetchColumn();

					// $course_set = $db->query('SELECT COUNT(*) FROM courses');
				 	// $course_count = $course_set->fetchColumn();
					for($count=1; $count <= $course_count; $count++) {
						echo "<option value=\"{$count}\"";
						if ($current_course["position"] == $count) {
							echo " selected";
						}
						echo ">{$count}</option>";
					}
				?>
		    </select>
		  </p>
		  <p>Visible to guest users:
		    <input type="radio" name="visible" value="0" <?php if ($current_course["visible"] == 0) { echo "checked"; } ?> /> No
		    &nbsp;
		    <input type="radio" name="visible" value="1" <?php if ($current_course["visible"] == 1) { echo "checked"; } ?>/> Yes
		  </p>
		  <input type="submit" name="submit" value="Edit course" />
		</form>
		<br />
		<a href="manage_content.php">&laquo; Back</a>
		&nbsp;
		&nbsp;
		<a href="delete_course.php?course=<?php echo urlencode($current_course["id"]); ?>" onclick="return confirm('Are you sure?');">x Delete course</a>
		
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
<?php 
	require_once("../includes/db_connection_close.php"); 
?>