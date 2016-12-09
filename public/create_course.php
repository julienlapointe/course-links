<!-- PHP code invisible to user -->
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection_open.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/form_validation.php"); ?>
<?php confirm_logged_in(); ?>

<?php set_current_course_link(); ?>

<?php
if (isset($_POST['submit'])) {
	
	$name = $_POST["name"];
	$position = (int) $_POST["position"];
	$visible = (int) $_POST["visible"];
	
	// validations
	$required_fields = array($_POST["name"], $_POST["position"], $_POST["visible"]);
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("name" => 30);
	validate_max_lengths($fields_with_max_lengths);
	
	if (!empty($errors)) {
		$_SESSION["errors"] = $errors;
		redirect_to("create_course.php");
	}
	
	$sql  = "INSERT INTO courses (";
	$sql .= "name, position, visible";
	$sql .= ") VALUES (";
	$sql .= "?, ?, ?";
	$sql .= ")";
	
	try
	{
		$statement = $db->prepare($sql);
		$bindParamArray = array($name, $position, $visible);
		$result = $statement->execute($bindParamArray);
		// $statement->bindParam(":name", $name);
		// $statement->bindParam(":position", $position);
		// $statement->bindParam(":visible", $visible);
		// $result = $statement->execute();
	}
	catch (PDOException $error)
	{
		echo "ERROR: " . $error->getMessage();
	}

	if ($result) {
		// Success
		$_SESSION["message"] = "course created.";
		redirect_to("manage_content.php");
	} else {
		// Failure
		$_SESSION["message"] = "course creation failed.";
		redirect_to("create_course.php");
	}
	
}

?>

<!-- HTML markup visible to user -->
<?php $user_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php $errors = errors(); ?>
		<?php echo form_errors($errors); ?>
		
		<h2>Create course</h2>
		<form action="create_course.php" method="post">
			<p>Course name:
				<input type="text" name="name" value="" />
		  	</p>
		  	<p>Position:
			<select name="position">
				<?php
					$course_set = find_all_courses(false);
					// this is kind of hack...
					foreach($course_set as $row)
					{
						$course_count += 1;
					}
					for($count=1; $count <= ($course_count + 1); $count++) {
						echo "<option value=\"{$count}\">{$count}</option>";
					}
				?>
			</select>
		  	</p>
		  	<p>Visible to guest users:
			<input type="radio" name="visible" value="0" /> No
			&nbsp;
			<input type="radio" name="visible" value="1" /> Yes
		  	</p>
		  	<input type="submit" name="submit" value="Create course" />
		</form>
		<br />
		<a href="manage_content.php">&laquo; Back</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
<?php 
	require_once("../includes/db_connection_close.php"); 
?>