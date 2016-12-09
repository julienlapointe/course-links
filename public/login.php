<!-- login.php code is very similar to the CREATE pages for links, courses, users, etc. because we are CREATING a new session? -->
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection_open.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/form_validation.php"); ?>

<?php
// initialize $username var
$username = "";

// if the "submit" key in the $_POST super global var contains a value, then process the form...
if (isset($_POST['submit'])) 
{
	// validations
	// $required_fields = array("username", "password");
	$required_fields = array($_POST["username"], $_POST["password"]);
	validate_presences($required_fields);
	// if no errors from above validations, then attempt login
	if (empty($errors)) 
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		// if attempt_login() successfully finds the username and password in the Users table, then $found_user is set to the $user object with $username and $password keys; otherwise $found_user is FALSE
		$found_user = attempt_login($username, $password);
		// if $found_user contains a value that isn't FALSE or NULL, then log user in by storing the username and password in a session file that will be used to keep the user logged in 
		if ($found_user) 
		{
			$_SESSION["user_id"] = $found_user["id"];
			$_SESSION["username"] = $found_user["username"];
			// redirect user to the admin dashboard page
			redirect_to("dashboard.php");
		} 
		// otherwise, store the "failed login attempt" message in the session file 
		// NOTE TO SELF: should this be stored in the $_SESSION["error"] var? this is an error message...
		else 
		{
			$_SESSION["message"] = "Your username and/or password was not found.";
		}
	}
} 
// if this page wasn't accessed by submitting a form, then it was likely accessed via a GET request (user typing URL directly into browser) since this page is processed in the background and is invisible to users

?>

<!-- redirect user to a new page here? instead of single-page form processing? -->
<!-- login form -->
<?php $user_context = "between"; ?>
<?php include("../includes/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">
		<!-- display success and error messages -->
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		<!-- login form -->
		<h2>Login</h2>
		<br>
		<form action="login.php" method="post">
			<p>Username:
				<!-- sanitize $username value entered by user on previous login attempt so they do not need to re-enter it -->
				<input type="text" name="username" value="<?php echo htmlentities($username); ?>" class="form-field"/>
			</p>
			<p>Password:
				<input type="password" name="password" value="" class="form-field"/>
			</p>
			<input type="submit" name="submit" value="Submit" class="submit"/>
		</form>
		<br><br>
		<strong>Demo accounts</strong>
		<br><br>
		Standard Account
		<br>
		------------------------------
		<br>
		Username: student 
		<br>
		Password: student
		<br><br>
		Admin Account
		<br>
		------------------------------
		<br>
		Username: prof 
		<br>
		Password: prof
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
<?php 
	require_once("../includes/db_connection_close.php"); 
?>