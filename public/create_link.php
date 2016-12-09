<!-- link CREATE and link UPDATE code is very similar (also similar to login.php) -->

<!-- PHP code invisible to user -->
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection_open.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/form_validation.php"); ?>
<?php confirm_logged_in(); ?>

<?php set_current_course_link(); ?>

<?php
	// need to know the course of the new link before adding the link
	// if no course, then redirect to manage_content.php
	if (!$current_course) {
		// course ID was missing or invalid or course couldn't be found in database so redirect user back to manage_content.php
		redirect_to("manage_content.php");
	}
?>

<?php
// if the "submit" key in the $_POST super global var contains a value, then process the form...
if (isset($_POST['submit'])) 
{
	// validations
	// $required_fields = array("url", "title", "course_id", "position", "visible");
	$required_fields = array($_POST["url"], $_POST["title"], $_POST["course_id"], $_POST["position"], $_POST["visible"]);
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("title" => 500);
	validate_max_lengths($fields_with_max_lengths);
	// if no errors from above validations, then CREATE new link
	if (empty($errors)) 
	{
		// store values from $_POST in local variables
		$url = $_POST["url"];
		$title = $_POST["title"];
		$course_id = $current_course["id"];
		$position = (int) $_POST["position"];
		$visible = (int) $_POST["visible"];
		$user_id = $_SESSION["user_id"];
		// assemble the SQL query
		$sql  = "INSERT INTO links (";
		$sql .= "  url, title, course_id, position, visible, user_id";
		$sql .= ") VALUES (";
		$sql .= "?, ?, ?, ?, ?, ?";
		$sql .= ")";
		// process the query and store results in $result
		try
		{
			$statement = $db->prepare($sql);
			$bindParamArray = array($url, $title, $course_id, $position, $visible, $user_id);
			$result = $statement->execute($bindParamArray);
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}
		// if $result contains values, then the link was successfully CREATED
		if ($result) 
		{
			$_SESSION["message"] = "link created.";
			redirect_to("manage_content.php?course=" . urlencode($current_course["id"]));
		} 
		// otherwise, the link CREATION process failed
		else 
		{
			$_SESSION["message"] = "link creation failed.";
		}
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
		<?php echo form_errors($errors); ?>
		
		<h2>Create link</h2>
		<form action="create_link.php?course=<?php echo urlencode($current_course["id"]); ?>" method="post">
			<p>URL:
				<input type="text" name="url" value="" />
			</p>
			<p>Title:
				<input type="text" name="title" value="" />
			</p>
<!-- I added this code so that user can change the link's $course_id -->
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
						if ($current_course["id"] == $course["id"]) {
							echo " selected";
						}
						echo ">{$course["name"]}</option>";
					} ?>
				</select>
			</p>
			<p>Position:
				<select name="position">
				<?php
					$link_set = find_links_for_course($current_course["id"], $user_context);
					// $link_count = $link_set->rowCount();
					// this is kind of hack...
					foreach($link_set as $row)
					{
						$link_count += 1;
					}
					for($count=1; $count <= ($link_count + 1); $count++) {
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
			<input type="submit" name="submit" value="Create link" />
		</form>
		<br />
		<a href="manage_content.php?course=<?php echo urlencode($current_course["id"]); ?>">&laquo; Back</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
<?php 
	require_once("../includes/db_connection_close.php"); 
?>