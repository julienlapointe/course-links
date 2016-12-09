<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection_open.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/form_validation.php"); ?>
<?php confirm_logged_in(); ?>

<?php
	$user = find_user_by_id($_GET["id"]);
	
	if (!$user) {
		// user ID was missing or invalid or 
		// user couldn't be found in database
		redirect_to("manage_users.php");
	}
?>

<?php
if (isset($_POST['submit'])) {
	
	// validations
	// $required_fields = array("username", "password");
	$required_fields = array($_POST["email"], $_POST["username"], $_POST["password"]);
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("username" => 60);
	validate_max_lengths($fields_with_max_lengths);
	
	if (empty($errors)) {
		
		// UPDATE

		$email = $_POST["email"];
		$hashed_password = password_encrypt($_POST["password"]);
		$username = $_POST["username"];
		$bio = $_POST["bio"];
		$id = $user["id"];
	
		$sql  = "UPDATE users SET ";
		$sql .= "email = ?, ";
		$sql .= "hashed_password = ?, ";
		$sql .= "username = ?, ";
		$sql .= "bio = ? ";
		$sql .= "WHERE id = ? ";
		$sql .= "LIMIT 1";
		// $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		try
		{
			$statement = $db->prepare($sql);
			$bindParamArray = array($email, $hashed_password, $username, $bio, $id);
			$result = $statement->execute($bindParamArray);
			$user_count = $statement->fetchColumn();
		}
		catch (PDOException $error)
		{
			echo "ERROR: " . $error->getMessage();
		}

		// if ($result || mysqli_affected_rows($connection) == 1) {
		// if ($result || $result->rowCount() == 1) {
		if ($result || $user_count == 1) {
			// Success
			$_SESSION["message"] = "user updated.";
			redirect_to("manage_users.php");
		} else {
			// Failure
			$_SESSION["message"] = "user update failed.";
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
<!-- id="page" should not be replaced w/ id="link" -->
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		
		<h2>Edit user: <?php echo htmlentities($user["username"]); ?></h2>
		<form action="edit_user.php?id=<?php echo urlencode($user["id"]); ?>" method="post">
			<p>Email:
				<input type="text" name="email" value="<?php echo htmlentities($user["email"]); ?>" />
			</p>
			<p>Password:
				<input type="password" name="password" value="" />
			</p>
			<p>Username:
				<input type="text" name="username" value="<?php echo htmlentities($user["username"]); ?>" />
			</p>
			<p>Bio:<br />
				<textarea name="bio" rows="20" cols="80"><?php echo htmlentities($user["bio"]); ?></textarea>
			</p>
			<input type="submit" name="submit" value="Edit user" />
		</form>
		<br />
		<a href="manage_users.php">&laquo; Back</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
<?php 
	require_once("../includes/db_connection_close.php"); 
?>