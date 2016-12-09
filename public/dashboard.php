<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<!-- confirm that the user has logged in; if not, do not grant access to this page and redirect to the login page (login.php) -->
<?php confirm_logged_in(); ?>

<!-- set $user_context to "admin" for "admin" panel -->
<?php $user_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
<!-- what is the purpose of a non-breaking space here? -->
		&nbsp;
	</div>
	<div id="page">
		<h2>Dashboard</h2>
		<!-- htmlentities is used here in case the username contains reserved HTML characters (ex. < >) or a character that is not present on the keyboard (ex. §) to ensure that HTML does NOT misinterpret the dynamic string that is "echoed" -->
		<br>
		<p>Welcome to your dashboard, <?php echo htmlentities($_SESSION["username"]); ?>.</p>
		<br>
		<ul>
			<li><a href="manage_content.php">Manage Content</a></li>
			<li><a href="manage_users.php">Manage Users</a></li>
		</ul>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
