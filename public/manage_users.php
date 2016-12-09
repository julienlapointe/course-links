<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection_open.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
	$user_set = find_all_users();
?>

<?php $user_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
		<h2><a href="dashboard.php">&laquo; Back to menu</a></h2><br />
	</div>
	<div id="page">
		<?php echo message(); ?>
		<h2>Manage users</h2>
		<br>
		<table>
			<tr>
				<th>Username</th>
				<th colspan="2">Actions</th>
			</tr>
		<?php 
			// while($user = $user_set->fetch()) { '?'.'>'
			foreach($user_set as $user)  { ?>
			<tr>
				<td><?php echo htmlentities($user["username"]); ?></td>
				<td><a href="edit_user.php?id=<?php echo urlencode($user["id"]); ?>">> Edit</a></td>
				<td><a href="delete_user.php?id=<?php echo urlencode($user["id"]); ?>" onclick="return confirm('Are you sure?');">x Delete</a></td>
			</tr>
		<?php } ?>
		</table>
		<br />
		<a href="create_user.php">Add new user</a>
	</div>
</div>
<?php include("../includes/layouts/footer.php"); ?>
<?php 
	require_once("../includes/db_connection_close.php"); 
?>