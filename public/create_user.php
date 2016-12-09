<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection_open.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/form_validation.php"); ?>
<?php confirm_logged_in(); ?>

<?php
if (isset($_POST['submit'])) {
	// Process the form
	
	// validations
	// $required_fields = array("username", "password");
	$required_fields = array($_POST["email"], $_POST["username"], $_POST["password"]);
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("username" => 30);
	validate_max_lengths($fields_with_max_lengths);
	
	if (empty($errors)) {
		// CREATE

		$email = $_POST["email"];
		$hashed_password = password_encrypt($_POST["password"]);
		$username = $_POST["username"];
		$bio = $_POST["bio"];
		
		$sql  = "INSERT INTO users (";
		$sql .= "  email, hashed_password, username, bio";
		$sql .= ") VALUES (";
		$sql .= "?, ?, ?, ?";
		$sql .= ")";

		try
		{
			$statement = $db->prepare($sql);
			$bindParamArray = array($email, $hashed_password, $username, $bio);
			$result = $statement->execute($bindParamArray);
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}

		if ($result) {
			// success
			$_SESSION["message"] = "user created.";
			redirect_to("manage_users.php");
		} else {
			// failure
			$_SESSION["message"] = "user creation failed.";
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
		
		<h2>Create user</h2>
		<form action="create_user.php" method="post">
			<p>Email:
				<input type="text" name="email" value="" />
			</p>
			<p>Password:
				<input type="password" name="password" value="" />
			</p>
			<p>Username:
				<input type="text" name="username" value="" />
			</p>
			<p>Bio:<br />
				<textarea name="bio" rows="20" cols="80" value=""></textarea>
			</p>
			<input type="submit" name="submit" value="Create user" />
		</form>
		<br />
		<a href="manage_users.php">&laquo; Back</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
<?php 
	require_once("../includes/db_connection_close.php"); 
?>